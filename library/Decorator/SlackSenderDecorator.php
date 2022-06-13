<?php

namespace Decorator;

class SlackSenderDecorator implements ISender
{
    /**
     * @var ISender
     */
    private ISender $sender;

    /**
     * SlackSenderDecorator constructor.
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
        echo 'Sent by Slack <br>';

        $this->sender->send();
    }
}
