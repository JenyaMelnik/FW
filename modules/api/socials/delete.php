<?php

header('Content-type: json/application');

verifyApiToken();

verifyRequestMethod('DELETE');

deleteAuthViaSocial();


//if (!isset($_COOKIE['secret_token'])) {
//    echo json_encode('Вы не авторизированы. <br>Для авторизации введите в адресной строке: https://fw.loc/api/auth/login/{login}/{password}/{content type(default-JSON)}');
//    exit();
//}
//
//$queryTokenDate = q("
//    SELECT `secret_token_expire_date` FROM `fw_users`
//    WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
//");
//
//if (!$queryTokenDate->num_rows) {
//    echo json_encode('Не корректный secret token');
//    exit();
//}
//
//$tokenDate = $queryTokenDate->fetch_assoc();
//
//$now = new DateTime();
//$tokenExpiresDate = new DateTime($tokenDate['secret_token_expire_date']);
//
//if ($now > $tokenExpiresDate) {
//    echo json_encode('token просрочен, авторизируйтесь заново');
//    exit();
//}
//
//$method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];
//
//if ($method !== 'DELETE') {
//    echo json_encode('Не верный method');
//    exit();
//}
//
//if (!isset($_GET['socialId'])) {
//    echo json_encode('Вы не указали id соц. сети для удаления');
//    exit();
//}
//
//q("
//    DELETE FROM `fw_users2socials`
//    WHERE `user_id` = (SELECT `id` FROM fw_users WHERE secret_token = '" . es($_COOKIE['secret_token']) . "')
//    AND `social_id` = " . (int)($_GET['socialId']) . "
//    LIMIT 1
//");
//
//if (!DB::_()->affected_rows > 0) {
//    $response = 'соц. сеть с id: ' . $_GET['socialId'] . ' не найдена';
//    echo json_encode($response);
//    exit();
//}
//
//$response = 'авторизация через соц. сеть с id: ' . $_GET['socialId'] . ' удалена';
//echo json_encode($response);
//exit();
