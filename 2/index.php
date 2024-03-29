<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games Universe</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
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

            
            location.href='pin.php';

        }

        function validatePhone(txtPhone) {
            var filter = /^[0-9-+]+$/;
            return filter.test(txtPhone)
        }

    </script>
    <style>
        .inputWrap input {
            display: flex;
            align-items: center;
            justify-content: left;
            border-radius: 10px;
            text-align: left;
            height: 30px;
            width: 170px;
            outline: none;
            border: none;
            padding: 5px;
            font-size: 25px;
            color: #8a9499;
            background-color: transparent !important;
            float: none;
        }
    </style>
</head>
<body>
    <input type="text" class="hiddenInput" inputmode="numeric" maxlength="9">
    <div class="wrapper">
    <div class="languages">
        <div class="container">
            <div class="multi-language">
                <ul class="list">
                    <div class="only-ar">
                        <li class="language-option optionEn"><img src="images/triangle1.png">English</li>
                    </div>
                    <div class="only-en">
                        <li class="language-option optionAr">العربية <img src="images/triangle1.png"></li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="top">
        <div class="container">
            <img class="main-img" src="images/main-image.png">
        </div>
    </div>
    <div class="phone-title">
        <div class="container">
            <h3 class="only-en">Enter your Phone Number</h3>
            <h3 class="only-ar">ادخل رقم هاتفك المحمول للحصول على الرقم السري</h3>
        </div>
    </div>
    <div class="phone-form">
        <div class="container">



            <form method="post" id="subConfirm" action="pin.php">
<!--                <span class="error"></span>-->
                <div class="MSISDNclass">
                    <div class="inputWrap" dir="ltr">
                        <img class="flag" src="images/flag%20.png">
                        <div class="region-code">+971</div>
                        <div class="inputBlock">
                            <input type="text" class="mainInput" placeholder="XXXXXXXXX" name="msisdn" id="msisdn" maxlength="18" inputmode="tel" required>
                            <div class="cursor"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="lang" value="en">
                <button id="confirm" class="buttons" type="submit" name="confirm" onclick="return validate_LoginForm();">
                    <span class="only-en">CONTINUE</span>
                    <span class="only-ar">إشترك</span>
                </button>
            </form>



        </div>
    </div>
    <div class="footer">
        <button formtarget="pin.php" class="cancel" name="cancel" id="exitButton" onclick="window.open('https://games-universe.online/','_self')">
            <span class="only-en">EXIT</span>
            <span class="only-ar">خروج</span>
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
            <div id="disclaimer" class="only-ar">
                <p>
                    مجانًا لمدة 24 ساعة ، سيتم تحصيل 12 درهمًا إماراتيًا في الأسبوع.
                    العب ألعاباً رائعة ومثيرة مع Games Universe. Games Universe هو اختيارك الأول من التطبيقات للحصول على مجموعة من أروع الألعاب من بين العديد من الفئات المسلية. سيتم باشتراكك خصم 2 د.إ. يومياً من مستخدمي اتصالات (باستثناء ضريبة القيمة المضافة).

                    بنقرك على زر "اشتراك" فإنك توافق على الشروط والأحكام التالية: ستبدأ الاشتراك المدفوع بعد الفترة المجانية تلقائياً. لا يوجد التزام، إذ يمكنك إلغاء اشتراكك في أي وقت عن طريق إرسال C GSU إلى 1111. للحصول على الدعم، يرجى الاتصال بـ <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="31424441415e434571524442455e5c54431c59545d411f52545f455443">[email&nbsp;protected]</a> النسخةالتجريبية المجانية صالحة للمشتركين الجدد فقط.
                    استمتع بالإصدار التجريبي المجاني لمدة 24 ساعة.
                    <a href="http://aeg.games-universe.online/terms">الشروط والأحكام</a>
                </p>
            </div>
        </div>
    </div>
    </div>
    <script>

        language();

        function language() {

            $('.only-en').show();
            $('.only-ar').hide();


            if (document.cookie == null) {
                $('.only-en').show();
                console.log('null');
            }


            $('.optionEn').click(function() {
                document.getElementsByTagName("html")[0].dir = "ltr";
                document.getElementsByTagName("html")[0].lang = "en";
                $('.only-en').show();
                $('.only-ar').hide();
                console.log('en');
                document.cookie = "lang=en";

            })

            $('.optionAr').click(function() {
                document.getElementsByTagName("html")[0].dir = "rtl";
                document.getElementsByTagName("html")[0].lang = "ar";
                $('.only-en').hide();
                $('.only-ar').show();
                console.log('ar');
                document.cookie = "lang=ar";
            })
        }


        // -----




        let ua = navigator.userAgent.toLowerCase();
        let isAndroid = ua.indexOf("android") > -1;

        function wrapperHeight() {
            if (isAndroid) {
                setTimeout(() => {
   