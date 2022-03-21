<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../../_helpers/vendor/autoload.php';

use App\Pin;
use App\Logs;
use App\Exceptions\PincodeErrorException;
use Service_landing\Helpers\Filter;
use Service_landing\Helpers\Http;

$res = '';

if (!(
       isset($_GET['phone']) && (float)$_GET['phone']
    && isset($_GET['successUrl']) && substr($_GET['successUrl'], 0, 4) == 'http'
    && isset($_GET['failUrl']) && substr($_GET['failUrl'], 0, 4) == 'http'
    && !empty($_GET['wb_id'])
)) {
    Http::redirect('https://www.google.com/');
}

$pin = new Pin();
['wb_id' => $pin->wb_id, 'phone' => $pin->phone, 'successUrl' => $pin->successUrl, 'failUrl' => $pin->failUrl] = $_GET;
$pin->sub_land = (!empty($_GET['sub_land'])) ? $_GET['sub_land'] : 'main';

if (!Filter::isWebview() && !in_array($pin->sub_land, ['main'])) {
    $pin->sub_land = $_GET['sub_land'] = 'sub_1';
}

if ($pin->redis->exists("aegSubscribeBlock$pin->phone")) {
    Http::redirect('https://aeg.games-universe.online/');
}

if (isset($_POST['pin'])) {
    $pin->pincode = $_POST['pin'];

    try {
        $pin->submit();
    } catch (PincodeErrorException $e) {
        $res = $e->getMessage();
        Logs::log("pincode submit error: wb_id=$pin->wb_id, phone=$pin->phone, pin=$pin->pincode text=$res");
    }
}


// View
$sub_land = (!empty($_GET['sub_land'])) ? $_GET['sub_land'] : 'main';

$content = file_get_contents("lands/$sub_land/pin.html");

$content = str_replace('<head>', "<head>\n\t<base href=\"lands/$sub_land/\">", $content);

$currentUrl = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$content = str_replace('</body>', "<script>document.querySelector('form').setAttribute('action', '$currentUrl')</script></body>", $content);

if ($res) $content = str_replace('<p class="error"></p>', "<p class=\"error\">$res</p>", $content);

$content = str_replace('{phone}', $pin->phone, $content);

echo $content;