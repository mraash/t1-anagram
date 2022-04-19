<?php

declare(strict_types=1);

namespace Tests\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;
use App\Command\AnagramCommand;
use App\Exception\NonExistingFileException;
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
        $result = $this->commandTester->execute(['--file' => 'aaapchi.chi']);
        $output = $this->commandTester->getDisplay(true);

        $message = (new NonExistingFileException('aaapchi.chi'))->getMessage();

        $this->assertSame($result, AnagramCommand::FAILURE);
        $this->assertSame("{$message}\n", $output);
    }

    public function testExecutionWithNoOptions(): void
    {
        $this->commandTester->execute([]);
        $output = $this->commandTester->getDisplay();

        $this->assertEmpty($output);
    }
}
