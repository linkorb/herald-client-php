<?php

namespace Herald\Client;

class Message implements MessageInterface
{
    private $messageTemplate;
    private $toAddress;
    private $data;
    private $attachments = array();
    private $subject;
    private $body;

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

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;

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
        $data = array(
            'values' => $this->data,
            'attachments' => array(),
            'subject' => $this->subject,
            'body' => $this->body,
        );
        $attachments = $this->getAttachments();
        foreach ($attachments as $a) {
            $data['attachments'][] = array(
                'name' => $a['name'],
                'data' => base64_encode(file_get_contents($a['path'])),
            );
        }

        return json_encode($data);
        // $o = '';
        // foreach ((array) $this->data as $key => $value) {
        //     $o .= $key.':'.$value.',';
        // }
        // return substr($o, 0, -1);
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
