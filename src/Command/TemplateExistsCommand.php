<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Herald\Client\Message;

class TemplateExistsCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('template:exists')
            ->setDescription('Check if a message template exists on the Herald server')
            ->addArgument(
                'template',
                InputArgument::REQUIRED,
                'Name of the template'
            )
        ;
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getClient($input);

        if ($client->templateExists($input->getArgument('template'))) {
            $output->writeln('<info>Exists</info>');
        } else {
            $output->writeln('<error>Not found</error>');
        }
    }
}
