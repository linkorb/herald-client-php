<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ContactDeleteCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('contact:delete')
            ->setDescription('Delete contact')
            ->addArgument(
                'contactId',
                InputArgument::REQUIRED,
                'Contact ID'
            )
        ;
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = $this->getClient($input);
        $res = $c->deleteContact(intval($input->getArgument('contactId')));
        print_r($res);
    }
}
