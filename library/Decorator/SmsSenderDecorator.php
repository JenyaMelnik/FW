<?php

namespace Decorator;

class SmsSenderDecorator implements ISender
{
    /**
     * @var ISender
     */
    private ISender $sender;

    /**
     * SmsSenderDecorator constructor.
     * @param ISender $sender
     */
    public function __construct(ISender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed|void
     */
    public function send()
    {
        echo 'Sent by SMS <br>';

        $this->sender->send();
    }
}
