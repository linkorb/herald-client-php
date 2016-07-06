<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class PropertyDeleteCommand extends CommonCommand
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

        $res = $c->deleteProperty(intval($input->getArgument('propertyId')));
        print_r($res);
    }
}
