<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;

class ContactAddCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('contact:add')
            ->setDescription('Add contact to selected contact list')
            ->addArgument(
                'listId',
                InputArgument::REQUIRED,
                'ID of the list'
            )
            ->addArgument(
                'address',
                InputArgument::REQUIRED,
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
