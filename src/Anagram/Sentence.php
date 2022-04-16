<?php

declare(strict_types=1);

namespace App\Anagram;

/**
 * Class for string with many anagrams.
 */
class Sentence
{
    /** @var Word[] */
    private array $words;

    public function __construct(string $sentence)
    {
        $this->words = [];
        $splitedSentence = explode(' ', $sentence);

        foreach ($splitedSentence as $wordString) {
            $word = new Word($wordString);
            array_push($this->words, $word);
        }
    }

    public function getReversed(): string
    {
        $reversedWords = [];

        foreach ($this->words as $word) {
            array_push($reversedWords, $word->getAnagram());
        }

        return implode(' ', $reversedWords);
    }
}
