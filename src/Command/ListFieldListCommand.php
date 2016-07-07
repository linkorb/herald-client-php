<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class ListFieldListCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:fields')
            ->setDescription('Show list_fields for selected contact list')
            ->addOption(
                'listId',
                null,
                InputOption::VALUE_REQUIRED,
                'List ID'
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

        $res = $c->getListFields(intval($input->getOption('listId')));
        print_r($res);
    }
}
