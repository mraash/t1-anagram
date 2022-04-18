<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;
use Tests\Anagram\SentenceCreatorStub;
use Tests\Command\File\FileCreatorStub;

class AnagramCommandTest extends TestCase
{
    private CommandTester $commandTester;

    public function setUp(): void
    {
        $consoleApp = new Application();
        $consoleApp->add(new AnagramCommand(
            new SentenceCreatorStub(),
            new FileCreatorStub()
        ));

        $command = $consoleApp->find('app:anagram');

        $this->commandTester = new CommandTester($command);
    }

    public function tearDown(): void
    {
        unset($this->commandTester);
    }

    public function testExecutionWithStringOption(): void
    {
        $this->commandTester->execute(['--string' => 'abc']);
        $output = $this->commandTester->getDisplay(true);

        $this->assertSame("abc\n", $output);
    }

    public function testExecutionWithFileOptionEqualToExistingFile(): void
    {
        $this->commandTester->execute(['--file' => 'myfile.txt']);
        $output = $this->commandTester->getDisplay(true);

        $this->assertSame("string from file\n", $output);
    }

    public function testExecutionWithFileOptionEqualToNonExistingFile(): void
    {
        $this->commandTester->execute(['--file' => 'aaapchi.chi']);
        $output = $this->commandTester->getDisplay(true);

        $this->assertSame("File \"aaapchi.chi\" doesn't exist\n", $output);
    }

    public function testExecutionWithNoOptions(): void
    {
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        $this->assertEmpty($output);
    }
}
