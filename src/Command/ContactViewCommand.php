<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ContactViewCommand extends BaseCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('contact:view')
            ->setDescription('View selected contact')
            ->addArgument(
                'contactId',
                null,
                InputArgument::REQUIRED,
                'Contact ID'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $c = $this->getClient($input);

        $res = $c->viewContact(intval($input->getArgument('contactId')));
        print_r($res);

        return Command::SUCCESS;
    }
}
