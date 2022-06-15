<?php

namespace Api;

use SimpleXMLElement;

class XmlResponse implements IApi
{
    /**
     * @param array $response
     */
    public function printResponse(array $response): void
    {
        if (count($response, COUNT_RECURSIVE) - count($response) > 0) {
            $xml = new SimpleXMLElement('<xml-response/>');
            $response = array_map("array_flip", $response);
            array_walk_recursive($response, [$xml, 'addChild']);

            echo $xml->asXML();
            exit();
        }

        $xml = new SimpleXMLElement('<xml-response/>');
        $xmlResponse = array_flip($response);
        array_walk($xmlResponse, [$xml, 'addChild']);

        echo $xml->asXML();
        exit();
    }
}
