<?php

declare(strict_types=1);

namespace Tests\Anagram;

use App\Anagram\Sentence;

class SentenceStub extends Sentence
{
    public string $sentence;

    public function __construct(string $string)
    {
        $this->sentence = $string;
    }

    public function getReversed(): string
    {
        return $this->sentence;
    }
}
