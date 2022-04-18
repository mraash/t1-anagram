<?php

declare(strict_types=1);

namespace App\Anagram;

class SentenceFabric
{
    public function create(string $input): Sentence
    {
        return new Sentence($input);
    }
}
