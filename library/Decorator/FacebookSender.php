<?php

namespace Decorator;

class FacebookSender implements ISender
{
    /**
     *
     */
    public function send()
    {
        echo 'Sent by Facebook <br>';
    }
}
