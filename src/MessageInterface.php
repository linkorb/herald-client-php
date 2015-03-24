<?php

namespace Herald\Client;

interface MessageInterface
{
    public function getTemplate();
    public function setTemplate($template);
    public function getToAddress();
    public function setToAddress($toAddress);
    public function getData();
    public function setData($data);
}
