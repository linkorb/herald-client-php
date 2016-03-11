<?php

namespace Herald\Client;

class Message implements MessageInterface
{
    private $messageTemplate;
    private $toAddress;
    private $data = array();
    private $attachments = array();
    private $subject;
    private $body;

    public function __construct($templateName = null, $toAddress = null, $toName = null)
    {
        if ($templateName) {
            $this->setTemplate($templateName);
        }

        if ($toAddress) {
            $this->setToAddress($toAddress, $toName);
        }
    }

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

    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    private $uuid;

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    private $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    private $stamp;

    public function getStamp()
    {
        return $this->stamp;
    }

    public function setStamp($stamp)
    {
        $this->stamp = $stamp;

        return $this;
    }

    private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    private $fromAddress;

    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    public function setFromAddress($fromAddress)
    {
        $this->fromAddress = $fromAddress;

        return $this;
    }

    private $fromName;

    public function getFromName()
    {
        return $this->fromName;
    }

    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    private $to;

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    private $cc;

    public function getCc()
    {
        return $this->cc;
    }

    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    private $bcc;

    public function getBcc()
    {
        return $this->bcc;
    }

    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

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

    public function serializeData($skipAttachments = false)
    {
        $data = array(
            'values' => $this->data,
            'attachments' => array(),
            'subject' => $this->subject,
            'body' => $this->body,
        );

        if (!$skipAttachments) {
            $attachments = $this->getAttachments();
            foreach ($attachments as $a) {
                $data['attachments'][] = array(
                    'name' => $a['name'],
                    'data' => base64_encode(file_get_contents($a['path'])),
                );
            }
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
        $this->attachments [] = array('path' => $filePath, 'name' => $fileName);

        return $this;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }
}
