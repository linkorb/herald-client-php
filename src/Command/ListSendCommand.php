<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;

class ListSendCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:send')
            ->setDescription('Send messages to list or list segment')
            ->addOption(
                'listId',
                null,
                InputOption::VALUE_REQUIRED,
                'List ID'
            )
            ->addOption(
                'templateId',
                null,
                InputOption::VALUE_REQUIRED,
                'Template ID'
            )
            ->addOption(
                'segmentId',
                null,
                InputOption::VALUE_REQUIRED,
                'Segment ID. Do not specify this option if you want send messages to entire list.'
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

        $res = $c->sendList(
            intval($input->getOption('listId')),
            intval($input->getOption('segmentId')),
            intval($input->getOption('templateId'))
        );
        print_r($res);
    }
}
