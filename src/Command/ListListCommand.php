<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;

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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);

        $contacts = $c->getLists();
        print_r($contacts);
    }
}
