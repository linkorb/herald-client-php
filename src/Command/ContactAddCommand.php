<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

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
        $c = $this->getClient($input);

        $res = $c->addContact(
            intval($input->getArgument('listId')),
            $input->getArgument('address')
        );
        print_r($res);
    }
}
