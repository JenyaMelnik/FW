<?php
// Do nothing if the user is already logged in
if (!isset($_SESSION['user'])) {
    if (isset($_POST['id'])) {
        $queryUser = q("
        SELECT * FROM `fw_users`
        WHERE `facebook_id` = '" . es($_POST['id']) . "'
        LIMIT 1
    ");

        if ($queryUser->num_rows) {
            $user = $queryUser->fetch_assoc();
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['login'] = $user['login'];
            $_SESSION['user']['email'] = $user['email'];
            echo json_encode('authorized');
            exit();
        }

        $addUser = q("
            INSERT INTO `fw_users` SET 
            `login` = '" . es($_POST['firstName']) . "',
            `email` = '" . es($_POST['email']) . "',
            `facebook_id` = '" . es($_POST['id']) . "',
            `access` = 1
        ");


        if ($addUser) {
            $addedUserId = DB::_()->insert_id;

            q("
                INSERT INTO `fw_users2socials` SET
                `user_id` = " . $addedUserId . ",
                `social_id` = 1
            ");
            $_SESSION['user']['id'] = $addedUserId;
            $_SESSION['user']['login'] = $_POST['firstName'];
            $_SESSION['user']['email'] = $_POST['email'];
            echo json_encode('registered');
            exit();
        }
    }
} else {
    echo json_encode('already logged');
    exit();
}
