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

    public function send(MessageInterface $message, $skipNamePrefix = false)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/send/';
        $url .= $this->transportAccount.'/';
        $url .= $this->patchTemplateName($message->getTemplate(), $skipNamePrefix).'/';
        $url .= '?to='.$message->getToAddress();

        $body = $message->serializeData();

        // $attachments = $message->getAttachments();
        // foreach ($attachments as $a) {
        //     $body[] = new PostFile($a['name'], fopen($a['path'], 'r'));
        // }

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'headers' => ['content-type' => 'application/json'],
            'body' => $body,
        ]);
        //echo $res->getStatusCode();
        //echo $res->getHeader('content-type');
        //echo $res->getBody();

        /*
        $data = $res->json();
        if ($data['numFound']>0) {
        }
        return true;
        */

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
}
