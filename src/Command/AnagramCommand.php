<?php

namespace Src\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Src\Anagram\Sentence;
use Symfony\Component\Console\Input\InputOption;

class AnagramCommand extends Command
{
    private const OPTION_STRING = 'string';

    protected static $defaultName = 'app:anagram';

    protected function configure(): void
    {
        $this->addOption(self::OPTION_STRING, null, InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $string = strval($input->getOption(self::OPTION_STRING));
        $anagram = (new Sentence($string))->getReversed();

        $output->writeln($anagram);

        return Command::SUCCESS;
    }
}
