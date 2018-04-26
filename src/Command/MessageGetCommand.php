<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Message;

class MessageGetCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('message:get')
            ->setDescription('Get a recently sent messages from this herald account')
            ->addArgument(
                'messageId',
                InputArgument::REQUIRED,
                'ID of the message'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);
        $messageId = (string) $input->getArgument('messageId');
        $messages = $c->getMessageById($messageId);
        print_r($messages);
    }
}
