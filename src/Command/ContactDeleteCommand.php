<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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

        $res = null;

        if (!empty($input->getOption('contactId'))) {
            $res = $c->deleteContact(intval($input->getOption('contactId')));
            print_r($res);
        } else {
            $output->writeln('<error>Error: option contactId required </error>');
        }
    }
}
