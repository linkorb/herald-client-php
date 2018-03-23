<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class SegmentListCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('segment:list')
            ->setDescription('Show segments for selected contact list')
            ->addArgument(
                'listId',
                null,
                InputArgument::REQUIRED,
                'List ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);

        $res = $c->getSegments(intval($input->getArgument('listId')));
        print_r($res);
    }
}
