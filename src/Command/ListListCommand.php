<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListListCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:list')
            ->setDescription('Show list of contact lists on the Herald server')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $c = $this->getClient($input);

        $contacts = $c->getLists();
        print_r($contacts);

        return Command::SUCCESS;
    }
}
