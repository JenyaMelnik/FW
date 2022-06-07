<?php

header('Content-type: json/application');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {
    if (isset($_COOKIE['secret_token'])) {

        $queryUserData = q("
        SELECT GROUP_CONCAT(`fw_socials`.`social_name`) as `socials_name`, GROUP_CONCAT(`fw_socials`.`social_id`) as `socials_id`
        FROM `fw_users`
        RIGHT JOIN `fw_users2socials` ON `fw_users2socials` . `user_id` = `fw_users` . `id`
        RIGHT JOIN `fw_socials` ON `fw_socials` . `social_id` = `fw_users2socials` . `social_id`
        WHERE `fw_users`.`secret_token` = '" . $_COOKIE['secret_token'] . "'
        GROUP BY `fw_users`.`id`;
    ");

        if ($queryUserData->num_rows) {
            $userData = $queryUserData->fetch_assoc();

            $userSocialsId = explode(',', $userData['socials_id']);
            $userSocialsName = explode(',', $userData['socials_name']);

            $i = 0;
            foreach ($userSocialsId as $socialId) {
                $userSocials[$socialId] = $userSocialsName[$i];
                $i++;
            }
        }
        $response = $userSocials ?? 'Прикрепленные аккаунты соц. сетей отсутствуют';
        echo json_encode($response);
    } else {
        echo json_encode('Вы не авторизированы. Для авторизации введите в адресной строке: https://fw.loc/api/auth/login/{login}/{password}/{content type(default-JSON)}');
    }

} else {
    echo json_encode('Не корректный запрос');

}

exit();
