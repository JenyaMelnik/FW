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
            $_SESSION['user']['id'] = DB::_()->insert_id;
            $_SESSION['user']['login'] = $_POST['firstName'];
            echo json_encode('registered');
            exit();
        }
    }
} else {
    echo json_encode('already logged');
    exit();
}

