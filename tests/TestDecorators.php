<?php

namespace App\Tests;

use App\SimpleDecorator\Decorator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;

class TestDecorators extends KernelTestCase
{

    public function testWorkingCommand()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $code = $application->run(new ArrayInput(['app:working']));

        self::assertSame(0, $code);
    }

    public function testFailingCommand()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $code = $application->run(new ArrayInput(['app:failing']));

        self::assertSame(0, $code);
    }

    public function testSimpleDecoratedResolveToDecorator(): void
    {
        $simpleDecorator = self::getContainer()->get('simple_decorator');
        self::assertSame(Decorator::class, $simpleDecorator::class);

        $simpleDecorated = self::getContainer()->get('App\SimpleDecorator\Decorated');
        self::assertSame(Decorator::class, $simpleDecorated::class);
    }

    public function testDecoratedWithStackResolveToDecorator(): void
    {
        $stackDecorator = self::getContainer()->get('decorator_stack');
        self::assertSame(\App\DecoratorStack\Decorator::class, $stackDecorator::class);

        $stackDecorated = self::getContainer()->get('App\DecoratorStack\Decorated');
        self::assertSame(\App\DecoratorStack\Decorator::class, $stackDecorated::class);
    }
}