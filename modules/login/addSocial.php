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

        q("
            INSERT INTO `fw_users2socials` SET
            `user_id` = " . $_SESSION['user']['id'] . ",
            `social_id` = 1
        ");
        echo json_encode('added');
        exit();
    }
}
