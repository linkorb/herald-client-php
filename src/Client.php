<?php

namespace Herald\Client;

// use GuzzleHttp\Post\PostFile;
use GuzzleHttp\Client as GuzzleClient;

class Client implements MessageSenderInterface
{
    private $apiUrl;
    private $username;
    private $password;
    private $transportAccount;
    private $templateNamePrefix = '';
    private $toAddressOverride = null;

    public function __construct($username, $password, $apiUrl, $transportAccount)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
        $this->transportAccount = $transportAccount;
    }

    public function setTemplateNamePrefix($prefix)
    {
        $this->templateNamePrefix = $prefix;

        return $this;
    }

    public function setToAddressOverride($address)
    {
        $this->toAddressOverride = $address;

        return $this;
    }

    public function send(MessageInterface $message, $skipNamePrefix = false)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/send/';
        $url .= $this->transportAccount.'/';
        $url .= $this->patchTemplateName($message->getTemplate(), $skipNamePrefix).'/';
        $url .= '?to='.($this->toAddressOverride ? $this->toAddressOverride : $message->getToAddress());

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json'],
            'body' => $message->serializeData(),
        ]);

        return ($res->getStatusCode() == 200);
    }

    public function preview(MessageInterface $message, $skipNamePrefix = false)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/preview/';
        $url .= $this->patchTemplateName($message->getTemplate(), $skipNamePrefix).'/';
        $url .= '?to='.$message->getToAddress();

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json'],
            'body' => $message->serializeData(true),
        ]);

        return json_decode($res->getBody());
    }

    public function checkTemplate($templateName)
    {
        return $this->templateExists($templateName);
    }

    public function templateExists($templateName, $skipNamePrefix = false)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/checktemplate/'.$this->patchTemplateName($templateName, $skipNamePrefix);

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
        ]);

        $body = $res->getBody();
        if ($body) {
            if ($body->read(2) == 'ok') {
                return true;
            }
        }

        return false;
    }

    private function patchTemplateName($templateName, $skipNamePrefix = false)
    {
        if ($skipNamePrefix) {
            return $this->escapeTemplateName($templateName);
        } else {
            return $this->escapeTemplateName($this->templateNamePrefix.$templateName);
        }
    }

    private function escapeTemplateName($templateName)
    {
        return str_replace('/', '___', $templateName);
    }
    
    
    public function getMessages()
    {

        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/messages';

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
        ]);

        $body = $res->getBody();
        if ($body) {
            if ($body->read(2) == 'ok') {
                return true;
            }
        }
        $content = (string)$body;
        $data = json_decode($content, true);
        //print_r($data);
        
        $messages = array();
        
        foreach($data['items'] as $m) {
            $message = $this->arrayToMessage($m);
            $messages[] = $message;
        }

        return $messages;
    }
    
    public function getMessageById($messageId)
    {

        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl . '/messages/' . $messageId;

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
        ]);

        $body = $res->getBody();
        if ($body) {
            if ($body->read(2) == 'ok') {
                return true;
            }
        }
        $content = (string)$body;
        $data = json_decode($content, true);
        //print_r($data);
        
        $message = $this->arrayToMessage($data);

        return $message;
    }
    
    private function arrayToMessage($m)
    {
        $message = new Message();
        $message->setId($m['id']);
        $message->setUuid($m['uuid']);
        $message->setUser($m['user']);
        $message->setStamp($m['stamp']);
        $message->setStatus($m['status']);
        $message->setFromAddress($m['fromAddress']);
        $message->setFromName($m['fromName']);
        $message->setTo($m['to']);
        $message->setCc($m['cc']);
        $message->setBcc($m['bcc']);
        $message->setSubject($m['subject']);

        if (isset($m['template'])) {
            $template = new Template();
            $template->setId($m['template']['id']);
            $template->setUuid($m['template']['uuid']);
            $template->setCode($m['template']['code']);
            $template->setUser($m['template']['user']);
            $template->setStatus($m['template']['status']);
            $template->setFromAddress($m['template']['fromAddress']);
            $template->setFromName($m['template']['fromName']);
            $template->setTo($m['template']['to']);
            $template->setCc($m['template']['cc']);
            $template->setBcc($m['template']['bcc']);
            $template->setBody($m['template']['body']);
            $template->setBodyMarkup($m['template']['bodyMarkup']);

            $template = new Layout();
            $message->setTemplate($template);
        }
        return $message;
    }

}
