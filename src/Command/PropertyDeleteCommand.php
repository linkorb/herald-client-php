<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PropertyDeleteCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('property:delete')
            ->setDescription('Delete contact property')
            ->addArgument(
                'propertyId',
                InputArgument::REQUIRED,
                'Id of contact property'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $c = $this->getClient($input);

        $res = $c->deleteProperty(intval($input->getArgument('propertyId')));
        print_r($res);

        return Command::SUCCESS;
    }
}
