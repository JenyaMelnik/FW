<?php

use Api\Api;
use Api\JsonResponse;
use Api\XmlResponse;

$responseFormat = 'json';
header('Content-type: application/json');

if (isset($_GET['socialId']) && $_GET['socialId'] === 'xml') {
    $responseFormat = 'xml';
    header('Content-type: application/xml');
}

$responseFormat === 'json'
    ? $api = new Api(new JsonResponse())
    : $api = new Api(new XmlResponse());

$api->verifyApiToken();
$api->verifyRequestMethod('GET');
$api->printConnectedSocials();
