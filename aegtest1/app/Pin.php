<?php 

namespace App;

require_once __DIR__ . '/../../../landstat/vendor/autoload.php';

use App\Exceptions\PincodeErrorException;
use Stat\App\Controllers\StatController;

class Pin 
{


    /**
     * @var string
     */
    private const PIN_SUBMIT_URL = 'http://inspigate.com/go4mobility/pin_submit';


    /**
     * @var object
     */
    public $redis;


    /**
     * @var string
     */
    public $wb_id = '';


    /**
     * @var string
     */
    public $phone = '';


    /**
     * @var string
     */
    public $pincode = '';


    /**
     * @var string
     */
    public $successUrl = '';


    /**
     * @var string
     */
    public $failUrl = '';


    /**
     * @var string
     */
    public $sub_land = '';



    /**
     * Pin constructor
     */
    public function __construct()
    {
          //
         //Puma
        //
        require('/var/www/domains/puma/App/vendor/autoload.php');
        require('/var/www/domains/puma/App/config/config.php');
        $puma = new \Puma\Puma($_CONFIG);
        $this->redis = $puma->getRedis();
    }



    /**
     * @return void
     * @throws PincodeErrorException
     */
    public function submit(): void
    {
        try {
            if (strlen($this->pincode) !== 4) throw new PincodeErrorException('Check your PIN format and try again', 1);

            // StatController::savePin($this->wb_id, $this->pincode);

            $this->request();
        } catch (PincodeErrorException $e) {
            // StatController::pinError($this->wb_id, true, $e->getMessage());
            
            if ($e->getCode()) throw $e;
            else {
                Logs::log("pincode submit error: wb_id=$this->wb_id, phone=$this->phone, text=" . $e->getMessage());
                header("Location: $this->failUrl&error_code=0&error_description=" . urlencode($e->getMessage())); exit;
            }
        }
    }


    /**
     * @return void
     * @throws PincodeErrorException
     */
    private function request(): void
    {
        $params = [
            'wb_id' => $this->wb_id,
            'phone' => $this->phone,
            'pin' => $this->pincode,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => self::PIN_SUBMIT_URL,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_POSTFIELDS => $params,
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        Logs::log(self::PIN_SUBMIT_URL . " request: " . http_build_query($params) . ", response: $response");
        
        $data = json_decode(json_encode((array)@simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        if (isset($data['status']) && strtolower($data['status']) === 'ok') {
            // StatController::pinError($this->wb_id, false);
            // StatController::subscribe($this->wb_id);

            $this->redis->set("aegSubscribeBlock$this->phone", '');
            $this->redis->expire("aegSubscribeBlock$this->phone", 3600*12);

            header("Location: $this->successUrl"); exit;
        } 
        else if ((substr_count($response, 'Error code 118') || substr_count($response, 'Error code 117'))) throw new PincodeErrorException(Config::pinError($this->sub_land), 1);
        else if (substr_count($response, 'Wrong phone number')) throw new PincodeErrorException('Wrong phone number');
        else if (substr_count($response, 'Internal error, Please check logs')) throw new PincodeErrorException('Request limit reached');
        else throw new PincodeErrorException('Pincode submit error occurred', 1);
    }
}