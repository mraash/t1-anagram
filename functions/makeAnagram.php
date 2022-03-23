<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Anagram\Sentence;

function makeAnagram(string $input): string
{
    $sentence = new Sentence($input);
    return $sentence->getReversed();
}