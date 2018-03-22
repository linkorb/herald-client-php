<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class MessageListCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('message:list')
            ->setDescription('List recently sent messages for this herald account')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = new HeraldClient(
            $input->getOption('username'),
            $input->getOption('password'),
            $input->getOption('apiurl'),
            $input->getOption('account'),
            $input->getOption('library'),
            null
        );

        $messages = $c->getMessages();
        print_r($messages);
    }
}
