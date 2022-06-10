<?php

namespace Api;

class JsonResponse implements IApi
{
    public function verifyRequestMethod(string $correctMethod): void
    {
        $method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== $correctMethod) {
            $response = [
                'status' => 'error',
                'message' => 'Incorrect method'
            ];

            echo json_encode($response);
            exit();
        }
    }

    /**
     *
     */
    public function verifyLoginAndPassword(): void
    {
        if (!isset($_GET['login']) || !isset($_GET['password'])) {
            $response = [
                'status' => 'error',
                'message' => 'Not all data entered'
            ];

            echo json_encode($response);
            exit();
        }

        $sql = "
            SELECT `id`, `hash`, `password`
            FROM `fw_users` 
            WHERE `login` = '" . es($_GET['login']) . "'
            LIMIT 1
        ";

        $queryUserData = q($sql);

        if (!$queryUserData->num_rows) {
            $response = [
                'status' => 'error',
                'message' => 'Wrong login'
            ];

            echo json_encode($response);
            exit();
        }

        $userDada = $queryUserData->fetch_assoc();

        if (!password_verify($_GET['password'], $userDada['password'])) {
            $response = [
                'status' => 'error',
                'message' => 'Wrong password'
            ];

            echo json_encode($response);
            exit();
        }
    }

    /**
     *
     */
    public function createSecretToken(): void
    {
        $secretToken = md5(microtime(true) . rand(1, 1000000));

        setcookie('secret_token', $secretToken, time() + 600, '/');
        $_COOKIE['secret_token'] = $secretToken;

        $sql = "
            UPDATE `fw_users`
            SET `secret_token` = '" . $secretToken . "',
                `secret_token_expire_date` = NOW() + 1000
            WHERE `login` = '" . es($_GET['login']) . "'
            LIMIT 1
        ";

        q($sql);

        $response = [
            'status' => 'success',
            'message' => 'Congratulations, you have gained access to the API. secret_token = ' . $secretToken
        ];

        echo json_encode($response);
        exit();
    }

    /**
     *
     */
    public function verifyApiToken(): void
    {
        if (!isset($_COOKIE['secret_token'])) {
            $response = [
                'status' => 'error',
                'message' => 'You are not authorized',
                'login-link' => 'https://fw.loc/api/auth/login/{login}/{password}/{content type(default-JSON)}'
            ];

            echo json_encode($response);
            exit();
        }

        $sql = "
            SELECT `secret_token_expire_date` FROM `fw_users`
            WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
        ";

        $queryTokenDate = q($sql);

        if (!$queryTokenDate->num_rows) {
            $response = [
                'status' => 'error',
                'message' => 'Incorrect secret token'
            ];

            echo json_encode($response);
            exit();
        }

        $tokenDate = $queryTokenDate->fetch_assoc();

        $now = new DateTime();
        $tokenExpiresDate = new DateTime($tokenDate['secret_token_expire_date']);

        if ($now > $tokenExpiresDate) {
            $response = [
                'status' => 'error',
                'message' => 'token expired, please login again'
            ];

            echo json_encode($response);
            exit();
        }
    }

    /**
     *
     */
    public function printConnectedSocials(): void
    {
        $sql = "
            SELECT S.social_id, S.social_name
            FROM fw_users2socials US
            LEFT JOIN fw_socials S on S.social_id = US.social_id
            LEFT JOIN fw_users U on U.id = US.user_id
            WHERE U.secret_token = '" . es($_COOKIE['secret_token']) . "'
        ";

        $queryUserData = q($sql);

        if (!$queryUserData->num_rows) {
            $response = [
                'status' => 'error',
                'message' => 'Attached social accounts does not exist'
            ];

            echo json_encode($response);
            exit();
        }

        $userData = $queryUserData->fetch_all(MYSQLI_ASSOC);

        echo json_encode($userData);
        exit();
    }
}
