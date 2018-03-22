<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Client as HeraldClient;
use Herald\Client\Message;

//class CheckTemplateCommand extends Command
class CheckTemplateCommand extends CommonCommand
{
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('message:check-template')
            ->setDescription('Check if a message template exists on the Herald server')
            ->addArgument(
                'template',
                InputArgument::REQUIRED,
                'Name of the template'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*
        $c = new HeraldClient(
            $input->getOption('username'),
            $input->getOption('password'),
            $input->getOption('apiurl'),
            null
        );
        */
        $c = new HeraldClient(
            $input->getOption('username'),
            $input->getOption('password'),
            $input->getOption('apiurl'),
            $input->getOption('account'),
            $input->getOption('library'),
            null
        );

        if ($c->templateExists($input->getArgument('template'))) {
            $output->writeln('<info>Success!</info>');
        } else {
            $output->writeln('<error>Failed!</error>');
        }
    }
}
