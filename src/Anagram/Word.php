<?php

declare(strict_types=1);

namespace App\Anagram;

/**
 * Helper class for Sentence. It's responsible for one word in whole string.
 */
class Word
{
    /** @var string[] */
    private array $chars;
    private int $length;

    public function __construct(string $word)
    {
        $this->chars  = str_split($word);
        $this->length = strlen($word);
    }

    public function getAnagram(): string
    {
        $result = '';
        // Array of characters of the word, but without characters that do not need
        //   to be reversed
        $cleanChars = [];
        // Associative array of characters that do not need to be reversed, where
        //   key is position of character in word and value is character
        $dirtyChars = [];

        // Filling $cleanChars and $dirtyChars
        foreach ($this->chars as $i => $char) {
            if (self::isReversible($char)) {
                array_push($cleanChars, $char);
            } else {
                $dirtyChars[$i] = $char;
            }
        }

        // Make $result
        for ($i = 0; $i < $this->length; $i++) {
            if (!isset($dirtyChars[$i])) {
                $result .= array_pop($cleanChars);
            } else {
                $result .= $dirtyChars[$i];
            }
        }

        return $result;
    }

    /**
     * Some characters must stay in same place when we are making anagram. This metod
     *   checks is character one of theese.
     *
     * @param string $char  Character that you need to check.
     *
     * @return bool  True if character should change position, false if not.
     */
    private static function isReversible(string $char): bool
    {
        return preg_match('/[a-zA-Z]/', $char) === 1;
    }
}
