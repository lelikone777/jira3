<?php
require 'log.php';
$res = '';
function params_encode(array $params, $key = 'puma_api_key')
{
    $encrypted = openssl_encrypt(
        json_encode($params),
        'aes-256-ecb',
        md5($key),
        false,
        openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ecb'))
    );
    return str_replace('%', '-', urlencode($encrypted));
}

function init($phone)
{
    $params = [
        'method' => 'link',
        'host' => 'aeg.games-universe.online',
        'country' => 'ae',
        'operator' => 'go4mobility',
        //'phone' => $phone,
        'key' => params_encode(['time'=>time()]),
    ];

    $url = 'http://188.42.166.204/api/?' . http_build_query($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $response = curl_exec($ch);
    logs('request: ' . $url);
    logs('response: ' . $response);
    return @json_decode($response, true);
}


function init_extra($phone, $ext_id)
{
    $params = [
        'phone' => $phone,
        'subscription_id' => $ext_id,
    ];
    logs($params);
    $url = 'http://inspigate.com/go4mobility/init/extra';
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_POST => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_POSTFIELDS => $params,
    ]);
    $response = curl_exec($ch);
    logs($response);
    return @json_decode($response, true);
}

function redirect($phone, $ext_id = false)
{
    $wb_id = $ext_id;
    $successUrl = $failUrl = '';

    if ($ext_id !== false) {
        $data = init_extra($phone, $ext_id);
        if (isset($data['successUrl'], $data['failUrl'])) {
            $data['result'] = 'success';
            $successUrl = $data['successUrl'];
            $failUrl = $data['failUrl'];
        }
    } else {
        $data = init($phone);
        $wb_id = $data['wb_subscription_id'];
        //$successUrl = statusUrl($data, $phone, 'success');
        //$failUrl = statusUrl($data, $phone, 'failed');
        if ($data['result'] === 'success') {
            $data = init_extra($phone, $wb_id);
            if (isset($data['successUrl'], $data['failUrl'])) {
                $data['result'] = 'success';
                $successUrl = $data['successUrl'];
                $failUrl = $data['failUrl'];
            }
        }
    }

    if ($data['result'] === 'success') {
        header('Location: pin.php?' . http_build_query([
            'wb_id' => $wb_id,
            'phone' => $phone,
            'successUrl' => $successUrl,
            'failUrl' => $failUrl,
        ]));
        exit;
    }
    elseif (strpos($data['reason'], 'Subscription already exists') !== false) exists($data['reason'], $phone);
    elseif (isset($data['reason'])) return $data['reason'];
    else return 'Unknown error occurred';
}

function exists($reason, $phone)
{
    preg_match('/[0-9]{1,}\./', $reason, $wb_id);
    $wb_id = str_replace('.', '', $wb_id[0]);
    $url = successUrl(['init_id' => 'in0.2', 'service_id' => 16727, 'wb_subscription_id' => $wb_id], $phone);
    logs('already exists url: ' . $url);
    header('Location: ' . $url);exit;
}

function statusUrl($data, $phone, $status)
{
    $apihash = params_encode(['init_id'=>$data['init_id']]);
    $params = [
        'status' => $status,
        'domain' => 'aeg.games-universe.online',
        'init_id' => $data['init_id'],
        'wb_subscription_id' => $data['wb_subscription_id'],
        'service_id' => $data['service_id'],
        'payed' => $apihash,
        'apireq' => $apihash,
        'abonent' => $phone,
        'country' => 'ae',
        'operator' => 'go4mobility',
    ];
    $url = 'http://go.games-universe.online/return?' . http_build_query($params);
//    logs('successUrl: ' . $url);
    return $url;
}

function phoneRules($phone)
{
    $code = '971';

    if (substr($phone, 0, 3) !== '971') {
        if (substr($phone, 0, 1) === '0') $phone = substr_replace($phone, $code, 0, 1);
        else $phone = "$code$phone";
    }

    if (strlen($phone) === 12) return $phone;
    else return '';
}

if (isset($_POST['msisdn'])) {
    $phone = $_POST['msisdn'];

    if ($phone = phoneRules($phone)) {
        if (!empty($_GET['ext_id'])) {
            $res = redirect($phone, $_GET['ext_id']);
        }
        else $res = redirect($phone);
    } else {
        $res = 'Invalid phone number';
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Games Universe</title>
    <link rel="icon" type="image/png" href="./images/ico.png?v1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="./css/payment.css?v1.0" type="text/css" rel="stylesheet">
    <script>
        function validate_LoginForm() {

            var msisdn = document.getElementById('msisdn').value;
            msisdn = msisdn.replace(/^0+/,'');
            msisdn = msisdn.replace(/^\+/,'');
            msisdn = msisdn.replace(/^971/,'');


            if ((msisdn == null || msisdn == "")) {
                alert("Please enter mobile number");
                return false;
            }
            if (!validatePhone(msisdn)) {
                alert("Please Enter digits only");
                return false;
            }

            // document.getElementById('msisdn').value = msisdn;
            // document.getElementById("msisdn").style.display = "none";
            // document.getElementById("confirm").style.display = "none";
            // document.getElementById("subConfirm").style.display = "none";
            // this.form.submit();
            //document.location.href = './PIN_Etisalat.html';
        }


        function validatePhone(txtPhone) {
            var filter = /^[0-9-+]+$/;
            return filter.test(txtPhone)
        }

    </script>
</head>
<header>
    <div class="container">
        <img class="logo" src="images/games-universe.svg" alt="">
        <div class="multi-language">
            <ul class="list">
                <div class="only-ar">
                    <p>
                    <li class="language-option optionEn"><img src="images/triangle1.png?v1.0">English</li>
                    </p>
                </div>
                <div class="only-en">
                    <p>
                    <li class="language-option optionAr">العربية <img src="images/triangle1.png?v1.0"></li>
                    </p>
                </div>
            </ul>
        </div>
    </div>
    <br/>
</header>
<body>
<div class="top">
    <div class="container">
        <img class="main-img" src="./images/logo.png?v1.0" />
    </div>
</div>
<center>
</center>
<div class="container">
    <center>
        <h3 class="only-en">Enter your mobile number to receive PIN</h3>
        <h3 class="only-ar">&#1575;&#1583;&#1582;&#1604; &#1585;&#1602;&#1605; &#1607;&#1575;&#1578;&#1601;&#1603; &#1575;&#1604;&#1605;&#1581;&#1605;&#1608;&#1604; &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1587;&#1585;&#1610;</h3>
    </center>
    <form method="post" id="subConfirm">
        <center>
            <?= '<span class="error">' . $res . '</span>' ?>
            <div class="MSISDNclass" style="margin:0 auto; float:none;">
                <div class="inputWrap">
                    <img src="images/flag.png?v1.0" class="flag">
<!--                    <div class="region-code">-->
<!--                        +971-->
<!--                        <img src="images/triangle2.png?v1.0">-->
<!--                    </div>-->
                    <input type="text" placeholder="Phone Number" name="msisdn" id="msisdn" maxlength="18" inputmode="tel" required />
                </div>
            </div>
            <input type="hidden" name="lang" value="en" />
<!--            %HIDDEN%-->
            <br/>
            <center>
                <button id="confirm" class="buttons" type="submit" name="confirm" onclick="return validate_LoginForm();">
                    <span class="only-en">Subscribe</span>
                    <span class="only-ar">إشترك</span>
                </button>
            </center>
            <br/>
            <center>
                <button class="cancel" name="cancel" id="exitButton" onclick="window.open('https://games-universe.online/','_self')">
                    <span class="only-en">EXIT</span>
                    <span class="only-ar">&#1582;&#1585;&#1608;&#1580;</span>
                </button>
            </center>
        </center>
    </form>
    <br/>
    <div id="disclaimer" class="only-en">
        <center>Free for 24 hours then, you will be charged AED 12/week.</center>
        <center>Play awesome and exciting Games with Games Universe. Games Universe is your go-to app for a collection of the coolest games from many entertaining categories.</center>
        <ul class="bullets-en">
            <li>By Clicking on Subscribe, you agree to the below terms and conditions:</li>
            <li>You will start the paid subscription after 24 hours free period automatically. No commitment, you can cancel your subscription at any time by sending C GSU to 1111.</li>
            <li>To get support, please contact support@customer-help.center</li>
            <li>The free trial is valid only for new subscribers.</li>
            <li>Enjoy your Free trial for 24 hours.</li>
            <li>For complete T&C click <a href="http://aeg.games-universe.online/terms">here</a></li>
        </ul>
    </div>
    <div id="disclaimer" class="only-ar" style="text-align: right;">
        <center>&#1605;&#1580;&#1575;&#1606;&#1611;&#1575; &#1604;&#1605;&#1583;&#1577; 24 &#1587;&#1575;&#1593;&#1577; &#1548; &#1587;&#1610;&#1578;&#1605; &#1578;&#1581;&#1589;&#1610;&#1604; 12 &#1583;&#1585;&#1607;&#1605;&#1611;&#1575; &#1573;&#1605;&#1575;&#1585;&#1575;&#1578;&#1610;&#1611;&#1575; &#1601;&#1610; &#1575;&#1604;&#1571;&#1587;&#1576;&#1608;&#1593;.</center>
            <center>&#1575;&#1604;&#1593;&#1576; &#1571;&#1604;&#1593;&#1575;&#1576;&#1575;&#1611; &#1585;&#1575;&#1574;&#1593;&#1577; &#1608;&#1605;&#1579;&#1610;&#1585;&#1577; &#1605;&#1593; Games Universe. Games Universe &#1607;&#1608; &#1575;&#1582;&#1578;&#1610;&#1575;&#1585;&#1603; &#1575;&#1604;&#1571;&#1608;&#1604; &#1605;&#1606; &#1575;&#1604;&#1578;&#1591;&#1576;&#1610;&#1602;&#1575;&#1578; &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1605;&#1580;&#1605;&#1608;&#1593;&#1577; &#1605;&#1606; &#1571;&#1585;&#1608;&#1593; &#1575;&#1604;&#1571;&#1604;&#1593;&#1575;&#1576; &#1605;&#1606; &#1576;&#1610;&#1606; &#1575;&#1604;&#1593;&#1583;&#1610;&#1583; &#1605;&#1606; &#1575;&#1604;&#1601;&#1574;&#1575;&#1578; &#1575;&#1604;&#1605;&#1587;&#1604;&#1610;&#1577;. &#1587;&#1610;&#1578;&#1605; &#1576;&#1575;&#1588;&#1578;&#1585;&#1575;&#1603;&#1603; &#1582;&#1589;&#1605; 2 &#1583;.&#1573;. &#1610;&#1608;&#1605;&#1610;&#1575;&#1611; &#1605;&#1606; &#1605;&#1587;&#1578;&#1582;&#1583;&#1605;&#1610; &#1575;&#1578;&#1589;&#1575;&#1604;&#1575;&#1578; (&#1576;&#1575;&#1587;&#1578;&#1579;&#1606;&#1575;&#1569; &#1590;&#1585;&#1610;&#1576;&#1577; &#1575;&#1604;&#1602;&#1610;&#1605;&#1577; &#1575;&#1604;&#1605;&#1590;&#1575;&#1601;&#1577;).</center>
            <ul class="bullets-ar">
                <li>&#1576;&#1606;&#1602;&#1585;&#1603; &#1593;&#1604;&#1609; &#1586;&#1585; "&#1575;&#1588;&#1578;&#1585;&#1575;&#1603;" &#1601;&#1573;&#1606;&#1603; &#1578;&#1608;&#1575;&#1601;&#1602; &#1593;&#1604;&#1609; &#1575;&#1604;&#1588;&#1585;&#1608;&#1591; &#1608;&#1575;&#1604;&#1571;&#1581;&#1603;&#1575;&#1605; &#1575;&#1604;&#1578;&#1575;&#1604;&#1610;&#1577;: &#1587;&#1578;&#1576;&#1583;&#1571; &#1575;&#1604;&#1575;&#1588;&#1578;&#1585;&#1575;&#1603; &#1575;&#1604;&#1605;&#1583;&#1601;&#1608;&#1593; &#1576;&#1593;&#1583; &#1575;&#1604;&#1601;&#1578;&#1585;&#1577; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610;&#1577; &#1578;&#1604;&#1602;&#1575;&#1574;&#1610;&#1575;&#1611;. &#1604;&#1575; &#1610;&#1608;&#1580;&#1583; &#1575;&#1604;&#1578;&#1586;&#1575;&#1605;&#1548; &#1573;&#1584; &#1610;&#1605;&#1603;&#1606;&#1603; &#1573;&#1604;&#1594;&#1575;&#1569; &#1575;&#1588;&#1578;&#1585;&#1575;&#1603;&#1603; &#1601;&#1610; &#1571;&#1610; &#1608;&#1602;&#1578; &#1593;&#1606; &#1591;&#1585;&#1610;&#1602; &#1573;&#1585;&#1587;&#1575;&#1604; C GSU &#1573;&#1604;&#1609; 1111. &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1575;&#1604;&#1583;&#1593;&#1605;&#1548; &#1610;&#1585;&#1580;&#1609; &#1575;&#1604;&#1575;&#1578;&#1589;&#1575;&#1604; &#1576;&#1600; support@customer-help.center &#1575;&#1604;&#1606;&#1587;&#1582;&#1577;&#1575;&#1604;&#1578;&#1580;&#1585;&#1610;&#1576;&#1610;&#1577; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610;&#1577; &#1589;&#1575;&#1604;&#1581;&#1577; &#1604;&#1604;&#1605;&#1588;&#1578;&#1585;&#1603;&#1610;&#1606; &#1575;&#1604;&#1580;&#1583;&#1583; &#1601;&#1602;&#1591;.</li>
                <li>&#1575;&#1587;&#1578;&#1605;&#1578;&#1593; &#1576;&#1575;&#1604;&#1573;&#1589;&#1583;&#1575;&#1585; &#1575;&#1604;&#1578;&#1580;&#1585;&#1610;&#1576;&#1610; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610; &#1604;&#1605;&#1583;&#1577; 24 &#1587;&#1575;&#1593;&#1577;.</li>
                <li><a href="http://aeg.games-universe.online/terms">&#1575;&#1604;&#1588;&#1585;&#1608;&#1591; &#1608;&#1575;&#1604;&#1571;&#1581;&#1603;&#1575;&#1605;</a></li>
            </ul>
    </div>
</div>
<script>

    language();

    function language() {
        var userLang = navigator.language || navigator.userLanguage;
        $('.only-en').hide();
        $('.only-ar').hide();
        var x = document.cookie;
        if (x == null) {
            $('.only-en').show();
            $('#english').hide()
        }
        if (x.search("en") != -1 || x == "" || x == '') {
            document.getElementsByTagName("html")[0].dir = "ltr";
            document.getElementsByTagName("html")[0].lang = "en";
            console.log(2);
            document.cookie = "lang=en";
            $('.only-en').show();
            $('#english').hide()
        } else {
            console.log(3);
            document.cookie = "lang=ar";
            $('.only-ar').show();
            $('#arabic').hide()
        }
        if (x.search("ar") != -1) {
            document.getElementsByTagName("html")[0].dir = "rtl";
            document.getElementsByTagName("html")[0].lang = "ar";
            $('.only-ar').show();
            $('#arabic').hide()
        }
        $('.optionEn').addClass('current');
        $('.optionAr').click(function() {
            document.getElementsByTagName("html")[0].dir = "rtl";
            document.getElementsByTagName("html")[0].lang = "ar";
            $('#container').css({
                'text-align': 'right'
            });
            $(this).addClass('current');
            $('.only-en').hide();
            $('#arabbic').hide();
            $('#english').show();
            $('.optionEn').removeClass('current');
            $('.only-ar').show();
            $('#english').show();
            $('#arabic').hide();
            $('#msisdn').attr('placeholder', 'XXXXXXXXX');
            document.cookie = "lang=ar";
            var x = document.cookie
        });
        $('.optionEn').click(function() {
            document.getElementsByTagName("html")[0].dir = "ltr";
            document.getElementsByTagName("html")[0].lang = "en";
            $('#container').css({
                'text-align': 'left'
            });
            $(this).addClass('current');
            $('.only-ar').hide();
            $('#arabic').show();
            $('#english').hide();
            $('.optionAr').removeClass('current');
            $('.only-en ').show();
            $('#english').hide();
            $('#arabic').show();
            $('#msisdn').attr('placeholder', 'Phone Number');
            document.cookie = "lang=en";
            var x = document.cookie
        });
        if (userLang == 'ar' && $('.optionEn').hasClass("current")) {
            $('.optionAr').click()
        }
    }
</script>
</body>
</html>