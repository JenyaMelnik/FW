<?php

//if (!isset($_GET['response']) || $_GET['response'] == 'json' ) {
//    echo json_encode($status);
//} elseif ($_GET['response'] = 'xml') {
//    echo myFunctionXMLgeneration($status);
//} else {
//    echo HTMLformat($status);
//}
//exit();

// echo 'Проект - FW';
//if (isset($_SESSION['user'])) {
//    var_dump($_SESSION['user']);
//} else {
//    echo 'сессия не создана';
//}

//abstract class CacheAbstract
//{
//    abstract public function get();
//
//    abstract protected function set($value);
//
//    public function gc()
//    {
//        echo 11111;
//    }
//}
//
//interface CacheInterface
//{
//    public function get();
//    public function set($value);
//}
//
//
//class MyCache extends CacheAbstract
//{
//    private $id = '';
//    public $text = '';
//
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }
//
//    public function get()
//    {
//        if (file_exists('./cache/file/' . $this->id) && time() - filemtime('./cache/file/' . $this->id) < 5) {
//            echo 'FROM CACHE <br>';
//            $this->text = unserialize(file_get_contents('./cache/file/' . $this->id));
//            return true;
//        } else {
//            echo 'CREATE CACHE<br>';
//            return false;
//
//        }
//    }
//
//    public function set($value)
//    {
//        file_put_contents('./cache/file/' . $this->id, serialize($value));
//    }
//}
//
//class MyCacheMySql implements CacheInterface
//{
//    public function get()
//    {
//        // TODO: Implement get() method.
//    }
//    public function set($value)
//    {
//        // TODO: Implement set() method.
//    }
//}
//
//
//$cache = new MyCache('test');
//if ($cache->get()) {
//    echo $cache->text;
//} else {
//    $num1 = 1;
//    $num2 = 2;
//    $sum = $num1 + $num2;
//    $cache->set($sum);
//    echo $sum;
//}

