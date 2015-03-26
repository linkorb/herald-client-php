<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
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
                'apiurl',
                null,
                InputOption::VALUE_REQUIRED,
                'API URL of the herald server'
            )
            ->addOption(
                'transportaccount',
                null,
                InputOption::VALUE_REQUIRED,
                'Transport account on the herald server'
            )
            ->addOption(
                'template',
                null,
                InputOption::VALUE_REQUIRED,
                'Template to use for this message'
            )
            ->addOption(
                'to',
                null,
                InputOption::VALUE_REQUIRED,
                'To address'
            )
            ->addOption(
                'data',
                null,
                InputOption::VALUE_REQUIRED,
                'Data to pass'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = new HeraldClient(
            $input->getOption('username'),
            $input->getOption('password'),
            $input->getOption('apiurl'),
            $input->getOption('transportaccount')
        );

        $message = new Message();

        if ($template = $input->getOption('template')) {
            $message->setTemplate($template);
        }
        if ($toAddress = $input->getOption('to')) {
            $message->setToAddress($toAddress);
        }
        if ($data = $input->getOption('data')) {
            $message->setData($data);
        }

        if ($c->send($message)) {
            $output->writeln('<info>Success!</info>');
        } else {
            $output->writeln('<warning>Failed!</warning>');
        }
    }
}
