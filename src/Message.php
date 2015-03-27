<?php

namespace Herald\Client;

class Message implements MessageInterface
{
    private $messageTemplate;
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

    public function getToAddress()
    {
        return $this->toAddress;
    }
    public function setToAddress($toAddress)
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    public function setData($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function serializeData()
    {
        $o = '';
        foreach ((array) $this->data as $key => $value) {
            $o .= $key.':'.$value.',';
        }

        return substr($o, 0, -1);
    }
}
