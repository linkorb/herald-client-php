<?php
namespace Herald\Client;

use Herald\Client\Message;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    // private $baseurl = "http://www.herald.web";
    private $baseurl = "http://localhost:8787";
    private $apiPrefix = '/api/v1';
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function setBaseUrl($baseurl)
    {
        $this->baseurl = $baseurl;
        return $this;
    }

    public function send(Message $message)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->baseurl.$this->apiPrefix.'/send/';
        $url.= $message->getTransportAccount().'/';
        $url.= $message->getMessageTemplate().'/';
        $url.= '?to='.$message->getToAddress();
        // var_dump($url);die;

        $res = $guzzleclient->post($url, [
            'auth' => [$this->username, $this->password],
            'body' => [
                'data' => $message->getData()
            ]
        ]);
        //echo $res->getStatusCode();
        //echo $res->getHeader('content-type');
        //echo $res->getBody();
        $data = $res->json();
        if ($data['numFound']>0) {
        }
        return true;
    }
}
