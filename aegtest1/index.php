<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../../_helpers/vendor/autoload.php';

use App\LandInit;
use App\Logs;
use App\Exceptions\InvalidPhoneNumberException;
use App\Exceptions\ExtraInitException;
use Service_landing\Helpers\Filter;
use Service_landing\Helpers\Http;

error_reporting(E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

$res = '';

$sub_land = (!empty($_GET['sub_land'])) ? $_GET['sub_land'] : 'main';
$currentUrl = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// if (empty($_GET['ext_id'])) {
//     Http::redirect('https://www.google.com/');
// }

// if (!Filter::isWebview() && !in_array($sub_land, ['main'])) {
//     $sub_land = $_GET['sub_land'] = 'sub_4';
// }

$init = new LandInit();

$init->sub_land = $sub_land;
$init->landingUrl = preg_replace('/\?.*/', '', $currentUrl);

$init->wb_id = $_GET['ext_id'] ?? '';
unset($_GET['ext_id']);

// if ($init->redis->exists("aegErrorBlock$init->wb_id")) {
//     header('Location: https://www.google.com/'); exit;
// }

// $init->newAbonent();


if (isset($_POST['msisdn'])) {
    $init->phone = $_POST['msisdn'];
    unset($_POST['msisdn']);
    try {
        $init->submit();
    } catch (InvalidPhoneNumberException | ExtraInitException $e) {
        $res = $e->getMessage();
        Logs::log("phone submit error: wb_id=$init->wb_id, phone=$init->phone, text=$res");
    }
}


// View
$content = file_get_contents("lands/$sub_land/index.html");

$content = str_replace('<head>', "<head>\n\t<base href=\"lands/$sub_land/\">", $content);
$content = str_replace('</body>', "<script>document.querySelector('form').setAttribute('action', '$currentUrl')</script></body>", $content);

if ($res) $content = str_replace('<p class="error"></p>', "<p class=\"error\">$res</p>", $content);
else $content = str_replace('<p class="error"></p>', '', $content);

echo $content;