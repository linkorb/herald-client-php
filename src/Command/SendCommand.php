<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class SendCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('message:send')
            ->setDescription('Send a message through Herald')
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
               'baseurl',
               null,
               InputOption::VALUE_REQUIRED,
               'Base URL of the herald server'
            )
            ->addOption(
               'template',
               null,
               InputOption::VALUE_REQUIRED,
               'Template to use for this message'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = new HeraldClient($input->getOption('username'), $input->getOption('password'));
        $message = new Message();
        if ($input->hasOption('template')) {
            $message->setTemplate($input->getOption('template'));
        }
        if ($input->hasOption('baseurl')) {
            $c->setBaseUrl($input->getOption('baseurl'));
        }
        $results = $c->send($message);
        print_r($results);
    }
}
