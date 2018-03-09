<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class PropertyAddCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('property:add')
            ->setDescription('Add contact property')
            ->addArgument(
                'contactId',
                InputArgument::REQUIRED,
                'Contact ID'
            )
            ->addArgument(
                'listFieldId',
                InputArgument::REQUIRED,
                'List field ID'
            )
            ->addArgument(
                'value',
                InputArgument::REQUIRED,
                'Value'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);
        
        $res = $c->addProperty(
            intval($input->getArgument('contactId')),
            intval($input->getArgument('listFieldId')),
            $input->getArgument('value')
        );
        print_r($res);

    }
}
