<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Universe</title>
    <link rel="stylesheet" href="css/style.css?v=1.2">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
    <style>

        /*@font-face {*/
        /*    font-family: 'Crique Grotesk';*/
        /*    src: local('Crique Grotesk Medium'), local('Crique-Grotesk-Medium'),*/
        /*    url('../fonts/CriqueGrotesk-Medium.woff2') format('woff2'),*/
        /*    url('../fonts/CriqueGrotesk-Medium.woff') format('woff');*/
        /*    !*url('../fonts/CriqueGrotesk-Medium.ttf') format('truetype');*!*/
        /*    font-weight: bold;*/
        /*    font-style: normal;*/
        /*}*/

        * {
            box-sizing: border-box;
        }
        html, body {
            /*height: 100%;*/
        }

        html {
            color: #8a9499;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            text-align: center;
            min-height: 100%;
            margin: 0 auto;
        }
        body {
            margin: 0;
            padding: 0;
            /*font-family: 'Crique Grotesk', sans-serif;*/
            font-weight: 500;
            text-align: center;
            -webkit-text-size-adjust: 100%;
        }
        .wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }

        header {
            position: relative;
            max-width: 640px;
            padding: 0 10px;
            margin: 0 auto;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            height: 30px;
            margin: 0 auto;
            z-index: 1;
        }

        .multi-language {
            position: absolute;
            display: block;
            top: 20px;
            right: 0;
            z-index: 3;
        }

        .multi-language .list {
            display: inline-block;
            font-size: 14px;
            margin: 0;
            /*padding: 0;*/
            list-style: none;
            text-align: center;
            /*background-color: #24b6ff;*/
            padding: 0;
            border-radius: 6px;
            color: white;
        }

        .multi-language .list li {
            display: inline-block;
            cursor: pointer;
            color: #fff;
            margin: 0;
            border-top: none;
            text-align: center;
            min-width: 90px;
        }
        .multi-language img {
            width: 12px;
            margin-left: 5px;
            padding-bottom: 1px;
        }
        .top {
            position: relative;
            width: 100%;
            margin-top: -16px;
            /*background-image: linear-gradient(#00AAFF 0%, #fff 100%);*/
            background: linear-gradient(#2096e9 0%, white 100%) no-repeat;
            /*padding-bottom: 15px;*/
            padding-top: 6vh;
        }
        .main-img {
            width: 31%;
            max-width: 288px;
            margin: 0 auto;
            /*padding-top: 10vh;*/
            padding-top: 50px;
        }

        /* .current {
            border-top: none;
            background-color: rgba(235, 102, 84, 1);
            color: #ffffff !important;
            text-decoration: none !important;
            width: 40px;
            text-align: center
        } */

        .only-ar,
        .only-en {
            display: block;
        }

        h3 {
            /*color: #8A9499;*/
            /*font-size: 18px;*/
            margin: 0;
            font-size: 16px;
            color: #ff5d10;
            line-height: 1.2;
        }
        .error {
            color: red;
        }
        .flag {
            width: 40px;
            margin: 0 5px;
        }
        .region-code {
            margin: 0;
            display: flex;
            align-items: center;
            font-size: 25px;
        }
        .region-code img {
            width: 10px;
        }
        .inputWrap input {
            outline: none;
            font-size: 16px;
            border-bottom: 1px solid #c4c8cb;
            /*padding: 5px;*/
        }

        .bullets-ar {
            display: block;
            text-align: right
        }

        .bullets-en {
            display: block;
            text-align: left
        }

        .optionAr {
            font-family: Verdana, sans-serif
        }

        .price-info {
            padding-top: 20px
        }

        a,
        a:link {
            color: #000;
            text-decoration: underline
        }


        a:visited {
            color: #000;
            text-decoration: none
        }
        ul {
            list-style-type: none;
            text-align: left
        }
        .bullet-ar {
            text-align: right
        }
        .bullet-en {
            text-align: left
        }
        .buttons {
            flex: 1 1 auto;
            /*font-size: 20px;*/
            transition: 0.5s;
            /*color: #fff;*/
            /*font-size: 25px;*/
            /*font-weight: bold;*/
            /*background: #00AAFF;*/
            padding: 15px;
            /*width: 55%;*/
            /*border: none;*/
            /*border-radius: 50px;*/
            outline: none;

            width: 288px;
            height: 68px;
            margin-top: 15px;
            /*padding-top: 2px;*/
            font-family: inherit;
            color: #fff;
            font-size: 27.5px;
            text-transform: uppercase;
            background-color: #4dc3ff;
            border: none;
            border-radius: 15px;
        }
        .buttons span {
            top: 0;
            padding: 0;
            margin: 0;
            line-height: 38px
        }
        .buttonText {
            padding: 10px 0;
        }
        .cancel {
            flex: 1 1 auto;
            /*font-size: 20px;*/
            transition: 0.5s;
            color: #fff;
            /*background-color: #000;*/
            /*padding: 5px;*/
            width: 80px;
            height: 27px;
            border: none;
            /*border-radius: 50px;*/
            outline: none;

            /*margin: 0 0 10px 0;*/
            margin: 0 0 20px 0;
            padding: 5px 15px;
            display: inline-block;
            font-size: 14px;
            background-color: #4dc3ff;
            border-radius: 15px;
        }
        .MSISDNclass {
            width: 288px;
            display: flex;
            align-items: center;
            justify-content: center;
            float: none;
            /*clear: all;*/
            margin: 0 auto;
            padding-top: 5px;
            /*border-bottom: 2px solid #c4c8cb;*/
            color: #8a9499;
            border-bottom: 2px solid #878787;
        }
        .inputWrap {
            display: flex;
            align-items: center;
        }
        .inputWrap input {
            display: inline;
            float: none;
        }
        .inputWrap input {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-align: center;
            height: 30px;
            width: 170px;
            outline: none;
            border: none;
            font-size: 25px;
            /*padding: 5px;*/
            color: #8a9499;
            background-color: transparent;
        }
        .inputWrap input::-webkit-input-placeholder {
            color: #bebebe;
        }
        .inputWrap input::-moz-placeholder {
            color: #bebebe;
        }
        .inputWrap input:-ms-input-placeholder {
            color: #bebebe;
        }
        .inputWrap input::-ms-input-placeholder {
            color: #bebebe;
        }
        .inputWrap input::placeholder {
            color: #bebebe;
        }
        img {
            max-width: 400px
        }
        .container {
            max-width: 640px;
            padding: 0 10px;
            position: relative;
            margin: 0 auto
        }
        #disclaimer {
            text-align: center;
            z-index: 1;
            height: 16vh;
        }
        #disclaimer ul {
            padding: 0;
            text-align: center;
        }
        #disclaimer a {
            color: inherit;
        }

        .box {
            display: flex;
            flex-direction: column;
            align-items: end;
            justify-content: center;
        }

        @media (orientation: landscape) {
            /*.main-img {*/
            /*    width: 55vh;*/
            /*}*/
        }

        /* Iphones styles */

        /* Iphone 5 */
        @media only screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }
        /* Iphone 6 */
        @media only screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }

        /* IPhone 6+ */
        @media only screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }

        /* IPhone X */
        @media only screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }

        /* IPhone XR */
        @media only screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 2) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }

        /* IPhone XS Max */
        @media only screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation : landscape) {
            .buttonText {
                font-size: 9px;
            }
            #disclaimer {
                font-size: 8px;
            }
        }

        @media (orientation: portrait) {
            html, body {
                height: 100%;
            }
        }


        .footer-container {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: 20px;
            padding: 0 10px 2px;
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1;
            text-align: center;
            color: #747474;
        }
    </style>
</head>
<body>
    <input type="text" class="hiddenInput" inputmode="numeric" maxlength="9">
    <div class="wrapper">
        <header>
            <div class="container">
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
        </header>
        <div class="top">
            <div class="container">
                <img class="main-img" src="./images/main-image.png?v1.0" />
            </div>
        </div>
        <div class="container">
            <h3 class="only-en">Enter your Phone Number</h3>
            <h3 class="only-ar" style="font-size: 16px;">&#1575;&#1583;&#1582;&#1604; &#1585;&#1602;&#1605; &#1607;&#1575;&#1578;&#1601;&#1603; &#1575;&#1604;&#1605;&#1581;&#1605;&#1608;&#1604; &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1587;&#1585;&#1610;</h3>
        </div>
        <div class="container">
            <form method="post" id="subConfirm">
                <span class="error"></span>
                <div class="MSISDNclass" style="margin:0 auto; float:none;">
                    <div class="inputWrap" dir="ltr">
                        <img src="images/flag%20.png" class="flag">
                        <div class="region-code">+971</div>
                        <input type="text" placeholder="XXXXXXXXX" name="msisdn" id="msisdn" maxlength="18" inputmode="tel" required />
                    </div>
                </div>
                <input type="hidden" name="lang" value="en" />
                <button id="confirm" class="buttons" type="submit" name="confirm" onclick="return validate_LoginForm();">
                    <span class="only-en">CONTINUE</span>
                    <span class="only-ar">إشترك</span>
            </form>
        </div>
        <div class="footer-container">
            <button class="cancel" name="cancel" id="exitButton" onclick="window.open('https://games-universe.online/','_self')">
                <span class="only-en">EXIT</span>
                <span class="only-ar">&#1582;&#1585;&#1608;&#1580;</span>
            </button>
        <div class="box">
            <div id="disclaimer" class="only-en">
                <p>
                Free for 24 hours then, you will be charged AED 12/week.
                Play awesome and exciting Games with Games Universe. Games Universe is your go-to app for a collection of the coolest games from many entertaining categories.
                By Clicking on Subscribe, you agree to the below terms and conditions:
                You will start the paid subscription after 24 hours free period automatically. No commitment, you can cancel your subscription at any time by sending C GSU to 1111.
                To get support, please contact support@customer-help.center
                The free trial is valid only for new subscribers.
                Enjoy your Free trial for 24 hours.
                For complete T&amp;C click&nbsp;<a href="https://aeg.games-universe.online/terms">here</a>
                </p>
            </div>
            <div id="disclaimer" class="only-ar" style="font-size: 12px; line-height: 11px;">
                <p>
                &#1605;&#1580;&#1575;&#1606;&#1611;&#1575; &#1604;&#1605;&#1583;&#1577; 24 &#1587;&#1575;&#1593;&#1577; &#1548; &#1587;&#1610;&#1578;&#1605; &#1578;&#1581;&#1589;&#1610;&#1604; 12 &#1583;&#1585;&#1607;&#1605;&#1611;&#1575; &#1573;&#1605;&#1575;&#1585;&#1575;&#1578;&#1610;&#1611;&#1575; &#1601;&#1610; &#1575;&#1604;&#1571;&#1587;&#1576;&#1608;&#1593;.
                &#1575;&#1604;&#1593;&#1576; &#1571;&#1604;&#1593;&#1575;&#1576;&#1575;&#1611; &#1585;&#1575;&#1574;&#1593;&#1577; &#1608;&#1605;&#1579;&#1610;&#1585;&#1577; &#1605;&#1593; Games Universe. Games Universe &#1607;&#1608; &#1575;&#1582;&#1578;&#1610;&#1575;&#1585;&#1603; &#1575;&#1604;&#1571;&#1608;&#1604; &#1605;&#1606; &#1575;&#1604;&#1578;&#1591;&#1576;&#1610;&#1602;&#1575;&#1578; &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1605;&#1580;&#1605;&#1608;&#1593;&#1577; &#1605;&#1606; &#1571;&#1585;&#1608;&#1593; &#1575;&#1604;&#1571;&#1604;&#1593;&#1575;&#1576; &#1605;&#1606; &#1576;&#1610;&#1606; &#1575;&#1604;&#1593;&#1583;&#1610;&#1583; &#1605;&#1606; &#1575;&#1604;&#1601;&#1574;&#1575;&#1578; &#1575;&#1604;&#1605;&#1587;&#1604;&#1610;&#1577;. &#1587;&#1610;&#1578;&#1605; &#1576;&#1575;&#1588;&#1578;&#1585;&#1575;&#1603;&#1603; &#1582;&#1589;&#1605; 2 &#1583;.&#1573;. &#1610;&#1608;&#1605;&#1610;&#1575;&#1611; &#1605;&#1606; &#1605;&#1587;&#1578;&#1582;&#1583;&#1605;&#1610; &#1575;&#1578;&#1589;&#1575;&#1604;&#1575;&#1578; (&#1576;&#1575;&#1587;&#1578;&#1579;&#1606;&#1575;&#1569; &#1590;&#1585;&#1610;&#1576;&#1577; &#1575;&#1604;&#1602;&#1610;&#1605;&#1577; &#1575;&#1604;&#1605;&#1590;&#1575;&#1601;&#1577;).

                &#1576;&#1606;&#1602;&#1585;&#1603; &#1593;&#1604;&#1609; &#1586;&#1585; "&#1575;&#1588;&#1578;&#1585;&#1575;&#1603;" &#1601;&#1573;&#1606;&#1603; &#1578;&#1608;&#1575;&#1601;&#1602; &#1593;&#1604;&#1609; &#1575;&#1604;&#1588;&#1585;&#1608;&#1591; &#1608;&#1575;&#1604;&#1571;&#1581;&#1603;&#1575;&#1605; &#1575;&#1604;&#1578;&#1575;&#1604;&#1610;&#1577;: &#1587;&#1578;&#1576;&#1583;&#1571; &#1575;&#1604;&#1575;&#1588;&#1578;&#1585;&#1575;&#1603; &#1575;&#1604;&#1605;&#1583;&#1601;&#1608;&#1593; &#1576;&#1593;&#1583; &#1575;&#1604;&#1601;&#1578;&#1585;&#1577; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610;&#1577; &#1578;&#1604;&#1602;&#1575;&#1574;&#1610;&#1575;&#1611;. &#1604;&#1575; &#1610;&#1608;&#1580;&#1583; &#1575;&#1604;&#1578;&#1586;&#1575;&#1605;&#1548; &#1573;&#1584; &#1610;&#1605;&#1603;&#1606;&#1603; &#1573;&#1604;&#1594;&#1575;&#1569; &#1575;&#1588;&#1578;&#1585;&#1575;&#1603;&#1603; &#1601;&#1610; &#1571;&#1610; &#1608;&#1602;&#1578; &#1593;&#1606; &#1591;&#1585;&#1610;&#1602; &#1573;&#1585;&#1587;&#1575;&#1604; C GSU &#1573;&#1604;&#1609; 1111. &#1604;&#1604;&#1581;&#1589;&#1608;&#1604; &#1593;&#1604;&#1609; &#1575;&#1604;&#1583;&#1593;&#1605;&#1548; &#1610;&#1585;&#1580;&#1609; &#1575;&#1604;&#1575;&#1578;&#1589;&#1575;&#1604; &#1576;&#1600; <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="31424441415e434571524442455e5c54431c59545d411f52545f455443">[email&#160;protected]</a> &#1575;&#1604;&#1606;&#1587;&#1582;&#1577;&#1575;&#1604;&#1578;&#1580;&#1585;&#1610;&#1576;&#1610;&#1577; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610;&#1577; &#1589;&#1575;&#1604;&#1581;&#1577; &#1604;&#1604;&#1605;&#1588;&#1578;&#1585;&#1603;&#1610;&#1606; &#1575;&#1604;&#1580;&#1583;&#1583; &#1601;&#1602;&#1591;.
                &#1575;&#1587;&#1578;&#1605;&#1578;&#1593; &#1576;&#1575;&#1604;&#1573;&#1589;&#1583;&#1575;&#1585; &#1575;&#1604;&#1578;&#1580;&#1585;&#1610;&#1576;&#1610; &#1575;&#1604;&#1605;&#1580;&#1575;&#1606;&#1610; &#1604;&#1605;&#1583;&#1577; 24 &#1587;&#1575;&#1593;&#1577;.
                <a href="http://aeg.games-universe.online/terms">&#1575;&#1604;&#1588;&#1585;&#1608;&#1591; &#1608;&#1575;&#1604;&#1571;&#1581;&#1603;&#1575;&#1605;</a>
                </p>
            </div>
        </div>
        </div>


    </div>
    <script src="js/script.js"></script>
    <script>

        language();

        function language() {
            var userLang = navigator.language || navigator.userLanguage;
            $('.only-en').hide();
            $('.only-ar').hide();
            var x = document.cookie;
            if (x == null) {
                $('.only-en').show();
                $('#english').show()
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
                document.cookie = "lang=en";
                $('.only-ar').hide();
                $('#arabic').show()
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
                $('.inputWrap').css({
                    'flex-direction': 'row'
                });
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
                $('#msisdn').attr('placeholder', 'XXXXXXXXX');
                document.cookie = "lang=en";
                var x = document.cookie
            });
            if (userLang == 'ar' && $('.optionEn').hasClass("current")) {
                $('.optionAr').click()
            }
        }


    </script>
    <script>
        document.onsubmit = () => {
            document.querySelector('button[type=submit]').setAttribute('disabled', 'disabled');
        }
  
        let input = document.querySelector('.hiddenInput');
        input.oninput = () => {
            input.value = input.value.replace(/[^0-9]/, '');
            if (input.value.substr(0, 2) === '05') input.setAttribute('maxlength', '10');
            else if (input.value.substr(0, 3) === '971') input.setAttribute('maxlength', '12');
            else input.setAttribute('maxlength', '9');
        }
    </script>
</body>
</html>
