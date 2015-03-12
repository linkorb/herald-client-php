<?php

namespace Herald\Client;

class Message
{
    private $template;
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
