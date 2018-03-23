<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;

class ListSendCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:send')
            ->setDescription('Send messages to list or list segment')
            ->addArgument(
                'listId',
                InputArgument::REQUIRED,
                'List ID'
            )
            ->addArgument(
                'templateId',
                InputArgument::REQUIRED,
                'Template ID'
            )
            ->addArgument(
                'segmentId',
                InputArgument::REQUIRED,
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
            intval($input->getArgument('listId')),
            intval($input->getArgument('segmentId')),
            intval($input->getArgument('templateId'))
        );
        print_r($res);
    }
}
