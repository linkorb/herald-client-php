<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Message;

class MessageListCommand extends BaseCommand
{
    protected function configure()
    {
        
        $this
            ->setName('message:list')
            ->setDescription('List recently sent messages for this herald account')
        ;
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);
        $messages = $c->getMessages();
        print_r($messages);
    }
}
