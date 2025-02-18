<?php

namespace Herald\Client\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Herald\Client\Client as HeraldClient;

abstract class BaseCommand extends Command
{
    protected function configure()
    {
        $this
            ->addOption(
                'dsn',
                null,
                InputOption::VALUE_REQUIRED,
                'DSN for the herald server'
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

    protected function getClient(InputInterface $input)
    {
        $dsn = null;
        $dsn = getenv('HERALD_DSN');
        if ($input->getOption('dsn')) {
            $dsn = $input->getOption('dsn');
        }

        if ($dsn) {
            $client = HeraldClient::fromDsn($dsn);
        } else {
            $client = new HeraldClient(
                $input->getOption('username'),
                $input->getOption('password'),
                $input->getOption('apiurl'),
                $input->getOption('account'),
                $input->getOption('library'),
                null
            );
        }
        return $client;
    }
}
