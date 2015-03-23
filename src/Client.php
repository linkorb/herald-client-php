<?php
namespace Herald\Client;

use Herald\Client\Message;
use GuzzleHttp\Client as GuzzleClient;

class Client
{
    // private $baseurl = "http://www.herald.web";
    // private $apiUrl = 'http://localhost:8787/api/v1';
    private $username;
    private $password;
    private $transportAccount;
    
    public function __construct($username, $password, $apiUrl, $transportAccount)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
        $this->transportAccount = $transportAccount;
    }

    public function send(Message $message)
    {
        $guzzleclient = new GuzzleClient();

        $url = $this->apiUrl.'/send/';
        $url.= $this->transportAccount.'/';
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
        
        /*
        $data = $res->json();
        if ($data['numFound']>0) {
        }
        return true;
        */

        return ($res->getStatusCode() == 200);
    }
}
