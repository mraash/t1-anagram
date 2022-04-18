<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use App\Anagram\SentenceCreator;
use App\Command\File\File;

class AnagramCommand extends Command
{
    private const OPTION_STRING = 'string';
    private const OPTION_FILE   = 'file';

    private SentenceCreator $sentenceCreator;

    protected static $defaultName = 'app:anagram';

    public function __construct(SentenceCreator $sentenceCreator = null)
    {
        parent::__construct();
        $this->sentenceCreator = $sentenceCreator ?? new SentenceCreator();
    }

    protected function configure(): void
    {
        $this->addOption(self::OPTION_STRING, null, InputOption::VALUE_REQUIRED);
        $this->addOption(self::OPTION_FILE, null, InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $givenString = $input->getOption(self::OPTION_STRING);
        $givenFile   = $input->getOption(self::OPTION_FILE);

        if ($givenString === null && $givenFile === null) {
            return Command::SUCCESS;
        }

        $stringValue = strval($givenString);
        $fileValue   = strval($givenFile);

        $string = isset($givenFile) ? self::getFileContent($fileValue) : $stringValue;

        $anagram = $this->sentenceCreator->create($string)->getReversed();

        $output->writeln($anagram);

        return Command::SUCCESS;
    }

    private static function getFileContent(string $filename): string
    {
        return (new File($filename))->getContent();
    }
}
