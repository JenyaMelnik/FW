<?php

// ================================ decorator ====================================

$facebookSender = new Decorator\FacebookSender();
$smsSenderDecorator = new Decorator\SmsSenderDecorator($facebookSender);
$slackSenderDecorator = new Decorator\SlackSenderDecorator($smsSenderDecorator);
$service = new Decorator\SenderService($slackSenderDecorator);

$service->send();
exit();

// ===============================================================================































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

