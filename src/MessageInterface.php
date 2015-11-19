<?php

namespace Herald\Client;

interface MessageInterface
{
    public function getTemplate();
    public function setTemplate(Template $template);
    public function getToAddress();
    public function setToAddress($toAddress);
    public function getData();
    public function setData($key, $value);
}
