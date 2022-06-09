<?php

namespace Api;

class JsonResponse
{
    public function verifyRequestMethod(string $correctMethod): void
    {
        $method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== $correctMethod) {
            $response = [
                'status' => 'error',
                'message' => 'incorrect method'
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
            echo json_encode('Вы ввели не все данные');
            exit();
        }

        $queryUserData = q("
    SELECT `id`, `hash`, `password`
    FROM `fw_users` 
    WHERE `login` = '" . es($_GET['login']) . "'
    LIMIT 1
");

        if (!$queryUserData->num_rows) {
            echo json_encode('wrong login');
            exit();
        }

        $userDada = $queryUserData->fetch_assoc();

        if (!password_verify($_GET['password'], $userDada['password'])) {
            echo json_encode('wrong password');
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

        q("
    UPDATE `fw_users`
    SET `secret_token` = '" . $secretToken . "',
        `secret_token_expire_date` = NOW() + 1000
    WHERE `login` = '" . es($_GET['login']) . "'
    LIMIT 1
");
        $response = 'Поздравляем, вы получили доступ к API. secret_token = ' . $secretToken;
        echo json_encode($response);
        exit();
    }

    /**
     * @throws Exception
     */
    public function verifyApiToken(): void
    {
        if (!isset($_COOKIE['secret_token'])) {
            $response = [
                'status' => 'error',
                'message' => 'Вы не авторизированы',
                'login-link' => 'https://fw.loc/api/auth/login/{login}/{password}/{content type(default-JSON)}'
            ];

            echo json_encode($response);
            exit();
        }

        $queryTokenDate = q("
        SELECT `secret_token_expire_date` FROM `fw_users`
        WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
");

        if (!$queryTokenDate->num_rows) {
            echo json_encode('Не корректный secret token');
            exit();
        }

        $tokenDate = $queryTokenDate->fetch_assoc();

        $now = new DateTime();
        $tokenExpiresDate = new DateTime($tokenDate['secret_token_expire_date']);

        if ($now > $tokenExpiresDate) {
            echo json_encode('token просрочен, авторизируйтесь заново');
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
            echo json_encode('Прикрепленные аккаунты соц. сетей отсутствуют');
            exit();
        }

        $userData = $queryUserData->fetch_all(MYSQLI_ASSOC);

        echo json_encode($userData);
        exit();
    }

    /**
     *
     */
    public function deleteAuthViaSocial(): void
    {
        if (!isset($_GET['socialId'])) {
            echo json_encode('Вы не указали id соц. сети для удаления');
            exit();
        }

        $sql = "
        DELETE FROM `fw_users2socials` 
        WHERE `user_id` = (SELECT `id` FROM fw_users WHERE secret_token = '" . es($_COOKIE['secret_token']) . "') 
        AND `social_id` = " . (int)($_GET['socialId']) . "
        LIMIT 1
        ";

        q($sql);

        if (!DB::_()->affected_rows > 0) {
            $response = 'соц. сеть с id: ' . $_GET['socialId'] . ' не найдена';
            echo json_encode($response);
            exit();
        }

        $response = 'авторизация через соц. сеть с id: ' . $_GET['socialId'] . ' удалена';
        echo json_encode($response);
        exit();
    }
}