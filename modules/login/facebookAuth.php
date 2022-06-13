<?php
// Do nothing if the user is already logged in
if (!isset($_SESSION['user'])) {
    if (isset($_POST['id'], $_POST['email'])) {

        function createSessionUser($query)
        {
            $user = $query->fetch_assoc();
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['login'] = $user['login'];
            $_SESSION['user']['email'] = $user['email'];
            $_SESSION['user']['role'] = $user['role'];
            echo json_encode('authorized');
            exit();
        }

// ==================================== if exist facebook_id - create Session user =====================================
        $sql = "
            SELECT * FROM `fw_users`
            WHERE `facebook_id` = '" . es($_POST['id']) . "'
            LIMIT 1
        ";

        $queryUser = q($sql);

        if ($queryUser->num_rows) {
            createSessionUser($queryUser);
        }

// ===================== if doesn't exist facebook_id but exist the same email as facebook: ============================
// =============================    add facebook_id and create Session user    =========================================
        $sql = "
            SELECT * FROM `fw_users` WHERE
            `email` = '" . es($_POST['email']) . "'
            LIMIT 1
        ";

        $sqlInsertFacebookId = "
            UPDATE `fw_users` SET
            `facebook_id` = '" . es($_POST['id']) . "'
            WHERE `email` = '" . es($_POST['email']) . "'
            LIMIT 1
        ";

        $checkEmail = q($sql);
        if ($checkEmail->num_rows) {
            q($sqlInsertFacebookId);
            createSessionUser($checkEmail);
        }

// ======================== if doesn't exist neither facebook_id nor the same email as facebook: ===============================
// ================================  create new user matched to facebook  ==========================================
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
