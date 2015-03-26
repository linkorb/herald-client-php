<?php

namespace Herald\Client;

interface MessageSenderInterface
{
    public function send(MessageInterface $message);
}
