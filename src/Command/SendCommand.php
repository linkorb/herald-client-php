<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Message;

class SendCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('send')
            ->setDescription('Send a message through Herald')
            // ->addArgument(
            //     'transportaccount',
            //     null,
            //     InputOption::VALUE_REQUIRED,
            //     'Transport account on the herald server'
            // )
            ->addArgument(
                'template',
                InputArgument::REQUIRED,
                'Template to use for this message'
            )
            ->addArgument(
                'to',
                InputArgument::REQUIRED,
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
        $c = $this->getClient($input);

        $message = new Message();

        if ($template = $input->getArgument('template')) {
            $message->setTemplate($template);
        }
        if ($toAddress = $input->getArgument('to')) {
            $message->setToAddress($toAddress);
        }
        if ($data = $input->getOption('data')) {
            $this->setDataFromString($data, $message);
        }

        if ($c->send($message)) {
            $output->writeln('<info>Success!</info>');
        } else {
            $output->writeln('<warning>Failed!</warning>');
        }
    }

    private function setDataFromString($dataString, Message $message)
    {
        $pairs = explode(',', $dataString);
        foreach ($pairs as $pair) {
            $part = explode(':', $pair);
            $message->setData(trim($part[0]), trim($part[1]));
        }
    }
}
