<?php

function my_session_start()
{
    if (ini_get('session.use_cookies') && isset($_COOKIE['PHPSESSID'])) {
        $sessid = $_COOKIE['PHPSESSID'];
    } elseif (!ini_get('session.use_only_cookies') && isset($_GET['PHPSESSID'])) {
        $sessid = $_GET['PHPSESSID'];
    } else {
        session_start();
        return true;
    }

    if (!preg_match('/^[-,a-zA-Z0-9]{1,128}$/', $sessid)) {
        return false;
    }
    session_start();

    return true;
}

if (!my_session_start()) {
    session_id(uniqid());
    session_start();
    session_regenerate_id();
}

class User extends \FW\User\User
{
    /** @var string */
    static string $avatar = '';

    /** @var array */
    static $datas = ['id', 'role', 'login', 'avatar'];

    /** @var int if the user is not authorized, captcha must be 1 */
    static int $captcha = 0;

    /** @var array */
    public static array $blockedIp = ['192.168.80.1', '192.168.80.2', '172.20.0.2'];

    /**
     * @param array $auth
     */
    static function Start($auth = [])
    {
        self::muteBlockedIp();
        parent::Start($auth);
        self::checkCaptcha();
        self::monitorAdmin();
    }

    /**
     * @param array $auth
     */
    static function Start($auth = [])
    {
        parent::Start($auth);
        self::muteBlockedIp();
        self::checkCaptcha();
        self::monitorAdmin();
    }

    /**
     *
     */
    static function muteBlockedIp(): void   // 1 задание - Заглушка.
    {
        if (isset($_SERVER['REMOTE_ADDR'])) {
            if (in_array($_SERVER['REMOTE_ADDR'], self::$blockedIp)) {
                header("HTTP/1.0 503 Service Unavailable");
                require './skins/stubroutine.tpl';
                exit;
            }
        }
    }

    /**
     * if the user is not authorized captcha will be 1
     */
    static function checkCaptcha(): void
    {
        if (!isset($_SESSION['user'])) {
            self::$captcha = 1;
        }
    }

    static function monitorAdmin(): void
    {
        $route = $_GET['route'] ?? '';
        $isAdminPanel = substr($route, 0, 5) == 'admin'; // bool

        if (isAdmin() && $isAdminPanel) {
            $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . $route;

            q("
                INSERT INTO `fw_monitor_admin` SET
                `url` =  '" . es($url) . "',
                `conversion_method` = '" . $_SERVER['REQUEST_METHOD'] . "'
            ");
        }
    }
}

User::Start(isset($_SESSION['user']['id']) ? ['id' => (int)$_SESSION['user']['id']] : []);

if (!isset($_SESSION['antixsrf'])) {
    $_SESSION['antixsrf'] = md5(time() . $_SERVER['REMOTE_ADDR'] . (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : rand(1, 99999)));
}
