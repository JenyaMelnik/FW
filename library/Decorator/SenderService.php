<?php

namespace Decorator;

class SenderService
{
    /**
     * @var ISender
     */
    private ISender $sender;

    /**
     * SenderService constructor.
     * @param ISender $sender
     */
    public function __construct(ISender $sender)
    {
        $this->sender = $sender;
    }

    /**
     *
     */
    public function send(): void
    {
        $this->sender->send();
    }
}
