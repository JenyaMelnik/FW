<?php

header('Content-type: json/application');

$method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];

if ($method !== 'DELETE') {
    echo json_encode('Не верный method');
    exit();
}

if (!isset($_COOKIE['secret_token'])) {
    echo json_encode('Вы не авторизированы');
    exit();
}

if (!isset($_GET['param1'])) {
    echo json_encode('Вы не указали id соц. сети для удаления');
    exit();
}

$queryUserId = q("
    SELECT `id` FROM `fw_users`
    WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
");

if (!$queryUserId->num_rows) {
    echo json_encode('Не действительный secret token');
    exit();
}

$userId = $queryUserId->fetch_assoc();

q("
    DELETE FROM `fw_users2socials` 
    WHERE `user_id` = " . (int)$userId['id'] . " 
    AND `social_id` = " . (int)($_GET['param1']) . "
    LIMIT 1
");

if (!DB::_()->affected_rows > 0) {
    $response = 'соц. сеть с id: ' . $_GET['param1'] . ' не найдена';
    echo json_encode($response);
    exit();
}

$response = 'авторизация через соц. сеть с id: ' . $_GET['param1'] . ' удалена';
echo json_encode($response);
exit();
