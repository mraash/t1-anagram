<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use App\Anagram\SentenceCreator;
use App\Command\File\FileCreator;
use App\Exception\NonExistingFileException;

class AnagramCommand extends Command
{
    private const OPTION_STRING = 'string';
    private const OPTION_FILE   = 'file';

    private SentenceCreator $sentenceCreator;
    private FileCreator $fileCreator;

    public function __construct(SentenceCreator $sentenceCreator = null, FileCreator $fileCreator = null)
    {
        parent::__construct();

        $this->sentenceCreator = $sentenceCreator ?? new SentenceCreator();
        $this->fileCreator     = $fileCreator ?? new FileCreator();
    }

    protected function configure(): void
    {
        $this
            ->setName('app:anagram')
            ->addOption(self::OPTION_STRING, null, InputOption::VALUE_REQUIRED)
            ->addOption(self::OPTION_FILE, null, InputOption::VALUE_REQUIRED);
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

        if (isset($givenFile)) {
            try {
                $string = $this->getFileContent($fileValue);
            } catch (NonExistingFileException $err) {
                $output->writeln("<error>{$err->getMessage()}</error>");
                return Command::FAILURE;
            }
        } else {
            $string = $stringValue;
        }

        $anagram = $this->sentenceCreator->create($string)->getReversed();

        $output->writeln($anagram);

        return Command::SUCCESS;
    }

    private function getFileContent(string $filename): string
    {
        return $this->fileCreator->create($filename)->getContent();
    }
}
