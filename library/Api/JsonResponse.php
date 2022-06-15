<?php

namespace Api;

class JsonResponse implements IApi
{
    /**
     * @param array $response
     */
    public function printResponse(array $response): void
    {
        echo json_encode($response);
        exit();
    }
}
