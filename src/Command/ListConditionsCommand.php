<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListConditionsCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('list:conditions')
            ->setDescription('Show List condition records.')
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

        $res = $c->getListConditions(intval($input->getArgument('listId')));
        print_r($res);
    }
}
