<?php

header('Content-type: json/application');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'DELETE') {
    $response = '';

    if (isset($_COOKIE['secret_token'], $_GET['param1'])) {
        $queryUserId = q("
        SELECT `id` FROM `fw_users`
        WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
    ");

        if ($queryUserId->num_rows) {
            $userId = $queryUserId->fetch_assoc();

            q("
            DELETE FROM `fw_users2socials` 
            WHERE `user_id` = " . (int)$userId['id'] . " AND
              `social_id` = " . (int)($_GET['param1']) . "
        ");

            if (\DB::_()->affected_rows > 0) {
                $response = 'авторизация через соц. сеть с id: ' . $_GET['param1'] . ' удалена';
                echo json_encode($response);
            } else {
                $response = 'соц. сеть с id: ' . $_GET['param1'] . ' не найдена';
                echo json_encode($response);
            }
        }
    } else {
        $response = 'Вы не авторизированы, или не указали id соц. сети для удаления';
        echo json_encode($response);
    }
} else {
    echo json_encode('Не корректный запрос');
}

exit();
