<?php

header('Content-type: json/application');

verifyRequestMethod('POST');

verifyLoginAndPassword();

createSecretToken();


//$method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];
//
//if ($method !== 'POST') {
//    echo json_encode('Не верный method');
//    exit();
//}
//
//if (!isset($_GET['login']) || !isset($_GET['password'])) {
//    echo json_encode('Вы ввели не все данные');
//    exit();
//}
//
//$queryUserData = q("
//    SELECT `id`, `hash`, `password`
//    FROM `fw_users`
//    WHERE `login` = '" . es($_GET['login']) . "'
//    LIMIT 1
//");
//
//if (!$queryUserData->num_rows) {
//    echo json_encode('wrong login');
//    exit();
//}
//
//$userDada = $queryUserData->fetch_assoc();
//
//if (!password_verify($_GET['password'], $userDada['password'])) {
//    echo json_encode('wrong password');
//    exit();
//}
//
//$secretToken = md5(microtime(true) . rand(1, 1000000));
//
//setcookie('secret_token', $secretToken, time() + 600, '/');
//$_COOKIE['secret_token'] = $secretToken;
//
//q("
//    UPDATE `fw_users`
//    SET `secret_token` = '" . $secretToken . "',
//        `secret_token_expire_date` = NOW() + 1000
//    WHERE `login` = '" . es($_GET['login']) . "'
//    LIMIT 1
//");
//$response = 'Поздравляем, вы получили доступ к API. secret_token = ' . $secretToken;
//echo json_encode($response);
//exit();
