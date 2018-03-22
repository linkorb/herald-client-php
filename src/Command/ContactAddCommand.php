<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;

class ContactAddCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('contact:add')
            ->setDescription('Add contact to selected contact list')
            ->addOption(
                'listId',
                null,
                InputOption::VALUE_REQUIRED,
                'List ID'
            )
            ->addOption(
                'address',
                null,
                InputOption::VALUE_REQUIRED,
                'Address'
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

        $res = null;

        if (!empty($input->getOption('listId')) && !empty($input->getOption('address'))) {
            $res = $c->addContact(
                intval($input->getOption('listId')),
                $input->getOption('address')
            );
        }
        print_r($res);
    }
}
