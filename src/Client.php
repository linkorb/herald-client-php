<?php
namespace Herald\Client;

use Herald\Client\Message;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    
    private $baseurl = "http://www.herald.web/";
    
    public function setBaseUrl($baseurl)
    {
        $this->baseurl = $baseurl;
    }

    public function send(Message $message)
    {
        $guzzleclient = new GuzzleClient();
        $res = $guzzleclient->get($this->baseurl . '/api/v1/send', ['auth' =>  [$this->username, $this->password]]);
        //echo $res->getStatusCode();
        //echo $res->getHeader('content-type');
        //echo $res->getBody();
        $data = $res->json();
        if ($data['numFound']>0) {
        }
        return true;
    }
}
