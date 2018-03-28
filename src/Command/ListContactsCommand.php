<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ListContactsCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:contacts')
            ->setDescription('Show contacts in selected contact list on the Herald server')
            ->addArgument(
                'listId',
                InputArgument::REQUIRED,
                'List ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);

        $res = $c->getContacts(intval($input->getArgument('listId')));
        print_r($res);
    }
}
