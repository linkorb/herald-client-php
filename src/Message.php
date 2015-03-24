<?php

namespace Herald\Client;

class Message implements MessageInterface
{
    private $messageTemplate;
    private $transportAccount;
    private $toAddress;
    private $data;

    public function getTemplate()
    {
        return $this->messageTemplate;
    }

    public function setTemplate($template)
    {
        $this->messageTemplate = $template;

        return $this;
    }
    /*
    public function setTransportAccount($ta)
    {
        $this->transportAccount = $ta;

        return $this;
    }

    public function getTransportAccount()
    {
        return $this->transportAccount;
    }
    */

    public function getToAddress()
    {
        return $this->toAddress;
    }
    public function setToAddress($toAddress)
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
