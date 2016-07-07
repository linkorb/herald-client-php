<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class PropertyAddCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('property:add')
            ->setDescription('Add contact property')
            ->addOption(
                'contactId',
                null,
                InputOption::VALUE_REQUIRED,
                'Contact ID'
            )
            ->addOption(
                'listFieldId',
                null,
                InputOption::VALUE_REQUIRED,
                'List field ID'
            )
            ->addOption(
                'value',
                null,
                InputOption::VALUE_REQUIRED,
                'Value'
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
        
        $res = $c->addProperty(
            intval($input->getOption('contactId')),
            intval($input->getOption('listFieldId')),
            $input->getOption('value')
        );
        print_r($res);

    }
}
