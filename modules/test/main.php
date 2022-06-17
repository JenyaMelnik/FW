<?php

// ================================ decorator ====================================

//$facebookSender = new Decorator\FacebookSender();
//$smsSenderDecorator = new Decorator\SmsSenderDecorator($facebookSender);
//$slackSenderDecorator = new Decorator\SlackSenderDecorator($smsSenderDecorator);
//$service = new Decorator\SenderService($slackSenderDecorator);
//
//$service->send();
//exit();

// ===============================================================================

//$zodiacSign = new \ZodiacSign\ZodiacSign();
//$myZodiac = $zodiacSign->getZodiacSign('1986-12-24');
//wtf($myZodiac);
?>

<!--<br/>-->
<!--UPDATE `fw_users`<br/>-->
<!--SET `secret_token` = '6c3007883d16814331d3ece78a9a2f17',<br/>-->
<!--`secret_token_expire_date` = NOW() + 1000<br/>-->
<!--WHERE `login` = 'Jenya'<br/>-->
<!--LIMIT 1<br/>-->
<!--<br/>-->
<!----Incorrect datetime value: '20220616136223' for column 'secret_token_expire_date' at row 2<br/>-->
<!----file: /var/www/html/library/Api/Api.php<br/>-->
<!----line: 104<br/>-->
<!----date: 2022-06-16 13: 52: 23<br/>-->
<!--===================================-->

<?php


//$queryUserData = q("
//        SELECT GROUP_CONCAT(`fw_socials`.`social_name`) as `social_name`, GROUP_CONCAT(`fw_socials`.`social_id`) as `social_id`
//        FROM `fw_users`
//        RIGHT JOIN `fw_users2socials` ON `fw_users2socials` . `user_id` = `fw_users` . `id`
//        RIGHT JOIN `fw_socials` ON `fw_socials` . `social_id` = `fw_users2socials` . `social_id`
//        WHERE `fw_users`.`secret_token` = '" . $_COOKIE['secret_token'] . "'
//        GROUP BY `fw_users`.`id`;
//    ");
//
//if ($queryUserData->num_rows) {
//    $userData = $queryUserData->fetch_assoc();
//
//    $userSocialsId = explode(',', $userData['social_id']);
//    $userSocialsName = explode(',', $userData['social_name']);
//
//    $i = 0;
//    foreach ($userSocialsId as $socialId) {
//        $userSocials[$socialId] = $userSocialsName[$i];
//        $i++;
//    }
//}
//
//echo json_encode($userSocials);
//exit();

//$expDateQuery = q("
//    SELECT `secret_token_expire_date` FROM `fw_users`
//    WHERE `id` = 3
//");
//
//$expDate = $expDateQuery->fetch_assoc();
//
//$exp = new DateTime($expDate['secret_token_expire_date']);
////wtf($exp);
//
//$now = new DateTime();
////wtf($now);
//
//if ($exp > $now) {
//    echo 'Токен действителен';
//} else {
//    echo 'Токен просрочен';
//}
//exit();


//$cache = new \Cache\CacheFile(1);
//$cache->write('qweqweqe');
//exit();


//trait MyTrait {
//    public $var = 1;
//    public function test() {
//        echo 'Hello';
//    }
//}
//
//class MyClass
//{
//    use MyTrait {
//        test as test2;
//    }
//}
//
//$x = new MyClass();
//$x->test2();
//
//
//
//exit();

//trait Singleton
//{
//    static $instance = false;
//    static public function getInstance()
//    {
//        if (!self::$instance) {
//            self::$instance = new self();
//        }
//        return self::$instance;
//    }
//}
//
//
//class TrySingleton
//{
//    use Singleton;
//    public $var = 1;
//    public function test() {
//        ++$this->var;
//        echo $this->var;
//    }
//}
//
//$x = TrySingleton::getInstance();
//$x->test();
//$x->test();
//
//$y = TrySingleton::getInstance();
//$y->test();

//LARAVEL examples:
//$user = User::create(['name' => 'Джон']); // создание
//
//// Редактирование
//$user = User::find(1);
//$user->email = 'john@foo.com';
//$user->save();
//
////удаление
//$user = User::find(1);
//$user->delete();

// ===============================================================================
//use Date\DateTimeAdapter;
//
//$dateAdapter = new DateTimeAdapter();
//$dateAdapter->modify('+1 day');
//echo $dateAdapter->format();

// ===============================================================================

//?>
<!--<script>-->
<!---->
<!--    FB.getLoginStatus(function (response) {-->
<!--        if (response.status === 'connected') {-->
<!--            var accessToken = response.authResponse.accessToken;-->
<!--        }-->
<!--    });-->
<!---->
<!---->
<!--    FB.api(-->
<!--        '/me', 'GET',-->
<!--        {-->
<!--            "client_id": "527634212260006",-->
<!--            "redirect_uri": "https://fw.loc/login/facebookAuth",-->
<!--            "client_secret": "EAAHf4WnLCKYBAMuE0BZBscltvPsVDbl3zPZAsNC8LHtbVGHbDZAGkEtlUb0RHVuJNniyZBlMztUUtSvzxS0fL79ouZBUcf31PP8dhmBNH6ZBkCQ3gBjxIs4850ndLIFBp8u7X0F1WVDyDaFsigrDlpzyfqh87ZB4v3nO5vRaNCqMeeqfwUeJYEJPtKUkBc1iweRmHJtzinIH6iZAUZC38auqoujTsKDTksn9Enhq3TWoEuShZC413otXgc",-->
<!--            "scope": "ads_management"-->
<!--        },-->
<!--        function (response) {-->
<!--            // Insert your code here-->
<!--        }-->
<!--    );-->
<!---->
<!---->
<!--</script>-->
<!---->
https://www.facebook.com/v14.0/dialog/oauth?client_id=527634212260006&redirect_uri=https://fw.loc/test/main&client_secret=EAAHf4WnLCKYBAOvKaxkz3XAzFqEYUGmuZBnJvebzNhHByZC2ZALx2ZCgHj5bFYOP96BdTpyOMeDSC0zPCumTZCpIl85AOCBXw1nwk4KZAQ88UiSvUIoIwZCegmw332axZB866oV4drpJrkshtaVIZCvQVCcLZCm8MYZBTC4BtiD1ZBWoZBo1OSskZCdmyTnLHaKcN1S5zvsNEXzonK7kAyNUvvIvZAdN2AVJ1crKgex2Wn4EM7XJj1xl1ZBLxR0Y&qwerty=123456
<!---->
<!--https://www.facebook.com/v2.9/dialog/oauth?client_id=1624315881114999&redirect_uri=https://school-php.com/login/fb&response_type=code-->
<!---->
<!--oauth/access_token?client_id=1638134336564464&redirect_uri=https://fw.loc/login/facebookAuth&client_secret=< YOUR_APP_SECRET >&code=< AUTHORIZATION_CODE >-->

<?php
wtf($_GET);

//https://www.facebook.com/v14.0/dialog/oauth?client_id=527634212260006&redirect_uri=https://fw.loc/test/main&client_secret=<secret token>

https://graph.facebook.com/me?fields=id,email,first_name,name&access_token=EAAHf4WnLCKYBAIRGHHQT3tJZAowDgd0xCHSEyt1Anaf5VhBd0PwOpWhW0po5OIK1HnTPvDTNSwfZAIq623ZCCX7jX1ZBv0AzBQrZARLLCKQGaNUS9HhJw1ifqTTO6uQD3z7ueXMPxjgWpzfbuXxpisNvwtKZAcZAP5aq5PlhnAD8H3uE2KZCQ2yrUeuojofC1CqgkillOwjMGTvR6p0Ops4ZC