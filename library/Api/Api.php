<?php

namespace Api;

class Api
{
    /**
     * @var IApi
     */
    private IApi $responseFormat;

    /**
     * Api constructor.
     * @param IApi $responseFormat
     */
    public function __construct(IApi $responseFormat)
    {
        $this->responseFormat = $responseFormat;
    }

    /**
     * @param string $correctMethod
     */
    public function verifyRequestMethod(string $correctMethod): void
    {
        $this->responseFormat->verifyRequestMethod($correctMethod);
    }

    /**
     *
     */
    public function verifyLoginAndPassword(): void
    {
        $this->responseFormat->verifyLoginAndPassword();
    }

    /**
     *
     */
    public function createSecretToken(): void
    {
        $this->responseFormat->createSecretToken();
    }

    /**
     *
     */
    public function verifyApiToken(): void
    {
        $this->responseFormat->verifyApiToken();
    }

    /**
     *
     */
    public function printConnectedSocials(): void
    {
        $this->responseFormat->printConnectedSocials();
    }

    /**
     *
     */
    public function deleteAuthViaSocial(): void
    {
        $this->responseFormat->deleteAuthViaSocial();
    }
}
