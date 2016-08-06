<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class MessageListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('message:list')
            ->setDescription('List recently sent messages for this herald account')
            ->addOption(
                'username',
                null,
                InputOption::VALUE_REQUIRED,
                'Username for the herald server'
            )
            ->addOption(
                'password',
                null,
                InputOption::VALUE_REQUIRED,
                'Password for the herald server'
            )
            ->addOption(
                'apiurl',
                null,
                InputOption::VALUE_REQUIRED,
                'API URL of the herald server'
            )
            ->addOption(
                'account',
                null,
                InputOption::VALUE_REQUIRED,
                'Account for the herald server'
            )
            ->addOption(
                'library',
                null,
                InputOption::VALUE_REQUIRED,
                'Library for the herald server'
            )
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
