<?php

namespace Api;

use DateTime;
use DB;
use SimpleXMLElement;

class XmlResponse implements IApi
{
    public function verifyRequestMethod(string $correctMethod): void
    {
        $method = $_POST['action'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== $correctMethod) {
            $response = [
                'status' => 'error',
                'message' => 'Incorrect method'
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
                'message' => 'Not all data entered'
            ];

            $xml = new SimpleXMLElement('<entered_data/>');
            $xmlResponse = array_flip($response);
            array_walk($xmlResponse, [$xml, 'addChild']);

            echo $xml->asXML();
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
                'message' => 'Wrong password'
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

        $xml = new SimpleXMLElement('<access/>');
        $xmlResponse = array_flip($response);
        array_walk($xmlResponse, [$xml, 'addChild']);

        echo $xml->asXML();
        exit();
    }
}
