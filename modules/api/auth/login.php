<?php

header('Content-type: json/application');

//$method = $_SERVER['REQUEST_METHOD'];

if (isset($_GET['login']) && isset($_GET['password'])) {
    $queryUserData = q("
        SELECT `id`, `hash`, `password`
        FROM `fw_users` 
        WHERE `login` = '" . es($_GET['login']) . "'
        LIMIT 1
");

    if (!$queryUserData->num_rows) {
        echo 'wrong login';
        exit();
    }

    $userDada = $queryUserData->fetch_assoc();
    if (password_verify($_GET['password'], $userDada['password'])) {

        $secretToken = md5(microtime(true) . rand(1, 1000000));

        setcookie('secret_token', $secretToken, time() + 600, '/');
        $_COOKIE['secret_token'] = $secretToken;

        q("
            UPDATE `fw_users` 
            SET `secret_token` = '" . $secretToken . "'
            WHERE `id` = " . $userDada['id'] . "
            LIMIT 1
        ");

        echo json_encode('Поздравляем, вы получили доступ к API' . PHP_EOL . 'secret_token = ' . $secretToken);
//        wtf($_GET);
    } else {
        echo 'wrong password';
    }
    exit();
}

//wtf($_GET);
