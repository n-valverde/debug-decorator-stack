<?php

namespace App\SimpleDecorator;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:working')]
class WorkingCommand extends Command
{
    public function __construct(private Decorator $service)
    {
        parent::__construct();
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $this->service->doSomething();

        return 0;
    }
}