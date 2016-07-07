<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class ContactPropertiesCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('contact:properties')
            ->setDescription('Get contact properties')
            ->addOption(
                'contactId',
                null,
                InputOption::VALUE_REQUIRED,
                'Contact ID'
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

        $res = $c->getContactProperties(intval($input->getOption('contactId')));
        print_r($res);
    }
}
