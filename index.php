<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Src\Anagram\Sentence;

// Main function
function makeAnagram(string $input): string
{
    $sentence = new Sentence($input);
    return $sentence->getReversed();
}

echo makeAnagram('A1bcd efg!h');
