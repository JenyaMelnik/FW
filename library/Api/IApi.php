<?php

namespace Api;

interface IApi
{
    /**
     * @param string $correctMethod
     */
    public function verifyRequestMethod(string $correctMethod): void;

    /**
     *
     */
    public function verifyLoginAndPassword(): void;

    /**
     *
     */
    public function createSecretToken(): void;

    /**
     *
     */
    public function verifyApiToken(): void;

    /**
     *
     */
    public function printConnectedSocials(): void;

    /**
     *
     */
    public function deleteAuthViaSocial(): void;
}
