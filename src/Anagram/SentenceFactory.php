<?php

declare(strict_types=1);

namespace App\Anagram;

class SentenceFactory
{
    public function create(string $input): Sentence
    {
        return new Sentence($input);
    }
}
