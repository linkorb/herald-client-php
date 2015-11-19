<?php

namespace Herald\Client;

class Template
{
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
    
    private $code;
    
    public function getCode()
    {
        return $this->code;
    }
    
    public function setCode($code)
    {
        $this->code = $code;
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
    
    
}
