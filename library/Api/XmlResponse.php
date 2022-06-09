<?php

namespace Api;

use SimpleXMLElement;

class XmlResponse
{
    public function verifyRequestMethod(string $correctMethod): void
    {
        $method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== $correctMethod) {
            $response = [
                'status' => 'error',
                'message' => 'incorrect method'
            ];
            $xml = new SimpleXMLElement('<method/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
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
                'message' => 'Вы ввели не все данные'
            ];
            $xml = new SimpleXMLElement('<data/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $queryUserData = q("
    SELECT `id`, `hash`, `password`
    FROM `fw_users` 
    WHERE `login` = '" . es($_GET['login']) . "'
    LIMIT 1
");

        if (!$queryUserData->num_rows) {
            $response = [
                'status' => 'error',
                'message' => 'wrong login'
            ];
            $xml = new SimpleXMLElement('<login/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $userDada = $queryUserData->fetch_assoc();

        if (!password_verify($_GET['password'], $userDada['password'])) {
            $response = [
                'status' => 'error',
                'message' => 'wrong password'
            ];
            $xml = new SimpleXMLElement('<password/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
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
        $response = [
            'status' => 'success',
            'message' => 'Congratulations, you have gained access to the API. secret_token = ' . $secretToken
        ];
        $xml = new SimpleXMLElement('<access/>');
        $xmlResponse = array_flip($response);
        array_walk($xmlResponse, [$xml, 'addChild']);
        echo $xml->asXML();
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
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $queryTokenDate = q("
    SELECT `secret_token_expire_date` FROM `fw_users`
    WHERE `secret_token` = '" . es($_COOKIE['secret_token']) . "'
");

        if (!$queryTokenDate->num_rows) {
            $response = [
                'status' => 'error',
                'message' => 'Не корректный secret token'
            ];
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $tokenDate = $queryTokenDate->fetch_assoc();

        $now = new DateTime();
        $tokenExpiresDate = new DateTime($tokenDate['secret_token_expire_date']);

        if ($now > $tokenExpiresDate) {
            $response = [
                'status' => 'error',
                'message' => 'token просрочен, авторизируйтесь заново'
            ];
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
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
                'message' => 'Прикрепленные аккаунты соц. сетей отсутствуют'
            ];
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $userData = $queryUserData->fetch_all(MYSQLI_ASSOC);
        $xml = new SimpleXMLElement('<socials/>');
        $userData = array_map("array_flip", $userData);
        array_walk_recursive($userData, [$xml, 'addChild']);
        echo $xml->asXML();
        exit();
    }

    /**
     *
     */
    public function deleteAuthViaSocial(): void
    {
        if (!isset($_GET['socialId'])) {
            $response = [
                'status' => 'error',
                'message' => 'Вы не указали id соц. сети для удаления'
            ];
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
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
            $response = [
                'status' => 'error',
                'message' => 'соц. сеть с id: ' . $_GET['socialId'] . ' не найдена'
            ];
            $xml = new SimpleXMLElement('<token/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);
            echo $xml->asXML();
            exit();
        }

        $response = [
            'status' => 'success',
            'message' => 'авторизация через соц. сеть с id: ' . $_GET['socialId'] . ' удалена'
        ];
        $xml = new SimpleXMLElement('<token/>');
        $xmlResponse = array_flip($response);
        array_walk($xmlResponse, [$xml, 'addChild']);
        echo $xml->asXML();
        exit();
    }
}