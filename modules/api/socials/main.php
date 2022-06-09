<?php

if (isset($_GET['socialId']) && $_GET['socialId'] === 'xml') {
    header('Content-type: application/xml');
} else {
    header('Content-type: application/json');
}

verifyApiToken();

verifyRequestMethod('GET');

printConnectedSocials();



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
//if ($method !== 'GET') {
//    echo json_encode('Не верный method');
//    exit();
//}
//
//$queryUserData = q("
//    SELECT GROUP_CONCAT(`fw_socials`.`social_name`) as `socials_name`, GROUP_CONCAT(`fw_socials`.`social_id`) as `socials_id`
//    FROM `fw_users`
//    RIGHT JOIN `fw_users2socials` ON `fw_users2socials` . `user_id` = `fw_users` . `id`
//    RIGHT JOIN `fw_socials` ON `fw_socials` . `social_id` = `fw_users2socials` . `social_id`
//    WHERE `fw_users`.`secret_token` = '" . es($_COOKIE['secret_token']) . "'
//    GROUP BY `fw_users`.`id`;
//");
//
//if (!$queryUserData->num_rows) {
//    echo json_encode('Прикрепленные аккаунты соц. сетей отсутствуют');
//    exit();
//}
//
//$userData = $queryUserData->fetch_assoc();
//
//$userSocialsId = explode(',', $userData['socials_id']);
//$userSocialsName = explode(',', $userData['socials_name']);
//
//$userSocials = [];
//$i = 0;
//foreach ($userSocialsId as $socialId) {
//    $userSocials[$socialId] = $userSocialsName[$i];
//    $i++;
//}
//
//echo json_encode($userSocials);
//exit();
