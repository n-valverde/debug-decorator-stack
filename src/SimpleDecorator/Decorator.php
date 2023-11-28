<?php

namespace App\SimpleDecorator;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Decorator implements EventSubscriberInterface
{
    private ?SymfonyStyle $io = null;

    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::COMMAND => 'onConsoleCommand',
        ];
    }

    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        dump('onCC: '. spl_object_hash($this));
        $this->io = new SymfonyStyle($event->getInput(), $event->getOutput());
    }

    public function doSomething(): void
    {
        if ($this->io === null) {
            throw new \LogicException('$this->io should be set at this point.');
        }

        dump('doing stuff: ' . spl_object_hash($this));
        $this->io->writeln('Working as expected');
    }
}