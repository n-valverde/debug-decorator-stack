<?php

namespace App\DecoratorStack;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:failing')]
class FailingCommand extends Command
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