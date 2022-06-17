<?php

// Do nothing if the user is already logged in
if (isset($_SESSION['user'])) {
    echo json_encode('already logged');
    exit();
}

if (isset($_POST['access_token'])) {
    $response = curl_init('https://graph.facebook.com/me?fields=id,email,first_name,name&access_token=' . $_POST['access_token']);

    curl_setopt($response, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($response, CURLOPT_HEADER, 0);
    $data = curl_exec($response);
    curl_close($response);

    $userData = json_decode($data, true);

    if (isset($userData['id'], $userData['email'])) {

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
            WHERE `facebook_id` = '" . es($userData['id']) . "'
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
            `email` = '" . es($userData['email']) . "'
            LIMIT 1
        ";

        $sqlInsertFacebookId = "
            UPDATE `fw_users` SET
            `facebook_id` = '" . es($userData['id']) . "'
            WHERE `email` = '" . es($userData['email']) . "'
            LIMIT 1
        ";

        $checkEmail = q($sql);
        if ($checkEmail->num_rows) {
            q($sqlInsertFacebookId);
            createSessionUser($checkEmail);
        }

// ======================== if doesn't exist neither facebook_id nor the same email as facebook: ===============================
// ================================  create new user bonded to facebook  ==========================================
        $addUser = q("
            INSERT INTO `fw_users` SET
            `login` = '" . es($userData['first_name']) . "',
            `email` = '" . es($userData['email']) . "',
            `facebook_id` = '" . es($userData['id']) . "',
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
            $_SESSION['user']['login'] = $userData['first_name'];
            $_SESSION['user']['email'] = $userData['email'];
            echo json_encode('registered');
            exit();
        }
    }
}
