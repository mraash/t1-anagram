<?php

declare(strict_types=1);

namespace Tests\Anagram;

use App\Anagram\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    public function testEmptiness(): void
    {
        $this->assertSentenceMatches('', '');
        $this->assertSentenceMatches(' ', ' ');
    }

    public function testMultipleWords(): void
    {
        self::assertSentenceMatches('word1 word2 word3', 'drow1 drow2 drow3');
    }

    public function testMultipleSpaces(): void
    {
        self::assertSentenceMatches('word1  word2', 'drow1  drow2');
        self::assertSentenceMatches('word1   word2  word3', 'drow1   drow2  drow3');
    }

    public function testSpacesAround(): void
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
