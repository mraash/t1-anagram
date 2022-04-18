<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;
use Tests\Anagram\SentenceCreatorStub;

class AnagramCommandTest extends TestCase
{
    private CommandTester $commandTester;

    public function setUp(): void
    {
        $consoleApp = new Application();
        $consoleApp->add(new AnagramCommand(new SentenceCreatorStub()));

        $command = $consoleApp->find('app:anagram');

        $this->commandTester = new CommandTester($command);
    }

    public function tearDown(): void
    {
        unset($this->commandTester);
    }

    public function testExecuteWithStringOption(): void
    {
        $this->commandTester->execute(['--string' => 'abc']);

        $display = $this->commandTester->getDisplay(true);
        $output  = self::standardizeLineBreak($display);

        $this->assertSame("abc\n", $output);
    }

    public function testExecuteWithNoOptions(): void
    {
        $this->commandTester->execute([]);
        $this->assertSame('', $this->commandTester->getDisplay());
    }

    /**
     * Replaces all \r\n and \r with \n in the given string
     */
    private static function standardizeLineBreak(string $string): string
    {
        return preg_replace('/(\r\n|\r)/', "\n", $string);
    }
}
