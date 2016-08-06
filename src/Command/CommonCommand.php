<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class CommonCommand extends Command
{
    protected function configure()
    {
        $this
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
            ->addOption(
                'account',
                null,
                InputOption::VALUE_REQUIRED,
                'Account name on the herald server'
            )
            ->addOption(
                'library',
                null,
                InputOption::VALUE_REQUIRED,
                'Library name on the herald server'
            )
        ;
    }
}
