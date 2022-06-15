<?php

namespace Api;

interface IApi
{
    /**
     * @param array $response
     */
    public function printResponse(array $response): void;
}
