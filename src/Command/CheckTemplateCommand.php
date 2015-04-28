<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

class CheckTemplateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('message:check-template')
            ->setDescription('Check if a message template exists on the Herald server')
            ->addArgument(
                'template',
                InputArgument::REQUIRED,
                'Name of the template'
            )
            ->addOption(
                'username',
                null,
                InputOption::VALUE_REQUIRED,
                'Username for the herald server'
            )
            ->addOption(
                'password',
                null,
                InputOption::VALUE_REQUIRED,
                'Password for the herald server'
            )
            ->addOption(
                'apiurl',
                null,
                InputOption::VALUE_REQUIRED,
                'API URL of the herald server'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $c = new HeraldClient(
            $input->getOption('username'),
            $input->getOption('password'),
            $input->getOption('apiurl'),
            null
        );

        if ($c->checkTemplate($input->getArgument('template'))) {
            $output->writeln('<info>Success!</info>');
        } else {
            $output->writeln('<error>Failed!</error>');
        }
    }
}
