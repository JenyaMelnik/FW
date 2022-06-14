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

$zodiacSign = new \ZodiacSign\ZodiacSign();
$myZodiac = $zodiacSign->getZodiacSign('2021-12-31');
wtf($myZodiac);















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

