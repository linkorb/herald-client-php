<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
                'FieldId',
                InputArgument::REQUIRED,
                'Field ID'
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
            intval($input->getArgument('FieldId')),
            $input->getArgument('value')
        );
        print_r($res);
    }
}
