<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use App\Anagram\SentenceFactory;
use App\Command\File\FileFactory;
use App\Exception\NonExistingFileException;

class AnagramCommand extends Command
{
    private const OPTION_STRING = 'string';
    private const OPTION_FILE   = 'file';

    private SentenceFactory $sentenceFactory;
    private FileFactory $fileFactory;

    public function __construct(SentenceFactory $sentenceFactory = null, FileFactory $fileFactory = null)
    {
        parent::__construct();

        $this->sentenceFactory = $sentenceFactory ?? new SentenceFactory();
        $this->fileFactory     = $fileFactory ?? new FileFactory();
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
            $output->writeln('<error>Please add --file or --string option</error>');
            return Command::INVALID;
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

        $anagram = $this->sentenceFactory->create($string)->getReversed();

        $output->writeln($anagram);

        return Command::SUCCESS;
    }

    private function getFileContent(string $filename): string
    {
        return $this->fileFactory->create($filename)->getContent();
    }
}
