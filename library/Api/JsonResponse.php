<?php

namespace Api;

class JsonResponse implements IApi
{
    public function printResponse(array $response): void
    {
        echo json_encode($response);
        exit();
    }
}
