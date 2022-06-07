<?php

header('Content-type: json/application');

$method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    if (isset($_GET['login']) && isset($_GET['password'])) {
        $queryUserData = q("
        SELECT `id`, `hash`, `password`
        FROM `fw_users` 
        WHERE `login` = '" . es($_GET['login']) . "'
        LIMIT 1
");

        if (!$queryUserData->num_rows) {
            echo json_encode('wrong login');
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
                WHERE `login` = '" . ($_GET['login']) . "'
                LIMIT 1
            ");
            $response = 'Поздравляем, вы получили доступ к API. secret_token = ' . $secretToken;
            echo json_encode($response);

        } else {
            echo json_encode('wrong password');
        }

    } else {
        echo json_encode('Вы ввели не все данные');
    }

} else {
    echo json_encode('Не верный method');
}

exit();
