<?php

if (isset($_POST['id'])) {
    $queryUser = q("
        SELECT * FROM `fw_users`
        WHERE `facebook_id` = '" . es($_POST['id']) . "'
        LIMIT 1
    ");

    if ($queryUser->num_rows) {
        echo json_encode('exist');
        exit();
    } else {
        q("
            UPDATE `fw_users` SET
            `facebook_id` = '" . $_POST['id'] . "'
            WHERE `id` = " . $_SESSION['user']['id'] . "
        ");

    }


}



echo 'socials - main <br>';

if (isset($_COOKIE['secret_token'])) {
    wtf($_COOKIE);
} else {
    echo 'Вы не авторизированы. Для авторизации введите в адресной строке: https://fw.loc/api/auth/login/{login}/{password}/{content type(default-JSON)}';
}

wtf( $_COOKIE);
