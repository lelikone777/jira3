<?php

namespace App;

require_once __DIR__ . '/../../../landstat/vendor/autoload.php';

use App\Exceptions\InvalidPhoneNumberException;
use App\Exceptions\ExtraInitException;
use Stat\App\Controllers\StatController;

class LandInit
{


    /**
     * @var string
     */
    private const EXTRA_INIT_URL = 'http://inspigate.com/go4mobility/init/extra';


    /**
     * @var string
     */
    private $init_id = '';


    /**
     * @var object
     */
    public $redis;


    /**
     * @var string
     */
    public $sub_land = 'main';


    /**
     * @var string
     */
    public $landingUrl = '';


    /**
     * @var int
     */
    public $wb_id = 0;


    /**
     * @var string
     */
    public $phone = '';



    public function __construct()
    {
          //
         //Puma
        //
        // require('/var/www/domains/puma/App/vendor/autoload.php');
        // require('/var/www/domains/puma/App/config/config.php');
        // $puma = new \Puma\Puma($_CONFIG);
        // $this->redis = $puma->getRedis();
    }



    /**
     * @return void
     */
    public function newAbonent(): void
    {
        // StatController::newAbonent($this->landingUrl, Config::serviceId($this->sub_land), $this->wb_id);
    }


    /**
     * @throws InvalidPhoneNumberException
     * @throws FatalErrorException
     * @throws ExtraInitException
     */
    public function submit(): void
    {
        
        try {
            // StatController::savePhone($this->wb_id, $this->phone);
            $this->phone = $this->phoneValidation();
        } catch (InvalidPhoneNumberException $e) {
            // StatController::phoneError($this->wb_id, true, $e->getMessage());
            throw $e;
        }

        try {
            $data = $this->extraInit();

            if ($data['code'] >= 500) {
                $failUrl = '';
                $resultCode = 0;

                ['failUrl' => $failUrl, 'resultCode' => $resultCode] = $data;

                // StatController::phoneError($this->wb_id, true, Config::operatorError($resultCode));
                // $this->redis->set("aegErrorBlock$this->wb_id", '');
                // $this->redis->expire("aegErrorBlock$this->wb_id", 3600*12);
                header("Location: $failUrl&error_code=$resultCode&error_description=" . urlencode(Config::operatorError($resultCode))); exit;
            }
        } catch (ExtraInitException $e) {
            // StatController::phoneError($this->wb_id, true, $e->getMessage());
            if (substr_count($e->getMessage(), 'Subscription already exists')) $this->alreadyExists($e->getMessage());
            else throw $e;
        }

        // StatController::phoneError($this->wb_id, false);

        header('Location: pin.php?' . http_build_query(array_merge($_GET, [
            'wb_id' => $this->wb_id,
            'phone' => $this->phone,
            'successUrl' => $data['successUrl'],
            'failUrl' => $data['failUrl'],
        ]))); exit;
    }


    /**
     * @return array
     * @throws ExtraInitException
     */
    private function extraInit(): array
    {
        $params = [
            'phone' => $this->phone,
            'subscription_id' => $this->wb_id,
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => self::EXTRA_INIT_URL,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_POSTFIELDS => $params,
        ]);
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        Logs::log(self::EXTRA_INIT_URL . " request: " . http_build_query($params) . " extra init response: http_code=" . $info['http_code'] . ", data=$response");
        
        
        if ($data = @json_decode($response, true)) {
            $data['code'] = $info['http_code'];
            
            if (isset($data['successUrl'], $data['failUrl'])) {
                return $data;
            }
            else if (isset($data['reason'])) {
                throw new ExtraInitException($data['reason']);
            }
            else {
                throw new ExtraInitException('Extra init unknown error');
            }
        }
        else {
            if (substr_count($response, 'Subscription already exists')) {

                $this->alreadyExists($response);

            } else {
                throw new ExtraInitException('Extra init unexpected response');
            }
        }
    }



    /**
     * @param string $reason
     * @return void
     */
    private function alreadyExists(string $reason): void
    {
        preg_match('/[0-9]{1,}\./', $reason, $wb_id);
        $this->wb_id = str_replace('.', '', $wb_id[0]);
        $this->init_id = '0.2';
        header('Location: ' . $this->statusUrl('success')); exit;
    }



    /**
     * @return string
     * @throws InvalidPhoneNumberException
     */
    private function phoneValidation(): string
    {
        $code = "971";
        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = substr_replace($phone, '', 0, 1);
        }
        
        if (substr($phone, 0, 3) === '971' && strlen($phone) === 12) {
            return $phone;
        }
        else if (strlen($phone) === 9) {
            return "$code$phone";
        }
        else {
            throw new InvalidPhoneNumberException();
        }
    }



    /**
     * @param string $status
     * @return string
     */
    private function statusUrl(string $status): string
    {
        return "http://go.games-universe.online/return?" . http_build_query([
            'status' => $status,
            'domain' => 'aeg.games-universe.online',
            'init_id' => $this->init_id,
            'wb_subscription_id' => $this->wb_id,
            'service_id' => Config::serviceId($this->sub_land),
            'payed' => Codec::paramsEncode(['init_id' => $this->init_id]),
            'apireq' => Codec::paramsEncode(['init_id' => $this->init_id]),
            'abonent' => $this->phone,
            'country' => 'ae',
            'operator' => 'go4mobility_etisalat',
        ]);
    }
}