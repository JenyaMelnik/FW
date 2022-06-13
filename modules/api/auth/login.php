<?php

use Api\Api;
use Api\JsonResponse;
use Api\XmlResponse;

$responseFormat = 'json';
header('Content-type: application/json');

if (isset($_GET['content-type']) && $_GET['content-type'] === 'xml') {
    $responseFormat = 'xml';
    header('Content-type: application/xml');
}

$responseFormat === 'json'
    ? $api = new Api(new JsonResponse())
    : $api = new Api(new XmlResponse());

$api->verifyRequestMethod('POST');
$api->verifyLoginAndPassword();
$api->createSecretToken();
