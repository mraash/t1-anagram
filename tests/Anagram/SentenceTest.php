<?php

declare(strict_types=1);

namespace Tests\Anagram;

use Src\Anagram\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    public function test_emptiness(): void
    {
        $this->assertSentenceMatches('', '');
        $this->assertSentenceMatches(' ', ' ');
    }

    public function test_multiple_words(): void
    {
        self::assertSentenceMatches('word1 word2 word3', 'drow1 drow2 drow3');
    }

    public function test_multiple_spaces(): void
    {
        self::assertSentenceMatches('word1  word2', 'drow1  drow2');
        self::assertSentenceMatches('word1   word2  word3', 'drow1   drow2  drow3');
    }

    public function test_spaces_around(): void
    {
        self::assertSentenceMatches(' word1 word2', ' drow1 drow2');
        self::assertSentenceMatches('word1 word2 ', 'drow1 drow2 ');
        self::assertSentenceMatches('  word1 word2  ', '  drow1 drow2  ');
    }

    private static function assertSentenceMatches($expected, $input): void
    {
        $sentence = new Sentence($input);
        $reversed = $sentence->getReversed();

        self::assertSame($expected, $reversed);
    }
}
