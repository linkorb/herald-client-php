<?php

namespace Herald\Client;

class Message implements MessageInterface
{
    private $messageTemplate;
    private $toAddress;
    private $data;
    private $attachments = array();

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
    public function setToAddress($toAddress, $name = null)
    {
        $this->toAddress = $toAddress;
        if ($name) {
            $this->toAddress .= ':'.$name;
        }

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

    public function setAttachment($filePath, $fileName = null)
    {
        if (!file_exists($filePath)) {
            throw new \Exception('Attachment not found: '.$filePath);
        }
        if ($fileName === null) {
            $info = pathinfo($filePath);
            $fileName = $info['basename'];
        }
        $this->attachments []= array('path' => $filePath, 'name' => $fileName);

        return $this;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }
}
