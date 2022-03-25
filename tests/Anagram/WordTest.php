<?php

declare(strict_types=1);

namespace Tests\Anagram;

use Src\Anagram\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /**
     * @dataProvider provideTypicalData
     */
    public function test_typical_behavior(string $expected, string $input): void
    {
        self::assertWordMatches($expected, $input);
    }

    public function provideTypicalData(): array
    {
        return [
            ['cba', 'abc'],
            ['tseTyM', 'MyTest'],
        ];
    }

    public function test_non_reversible_characters(): void
    {
        self::assertWordMatches('c11ba22', 'a11bc22');
        self::assertWordMatches('droW!', 'Word!');
    }

    public function test_emptiness(): void
    {
        self::assertWordMatches('', '');
        self::assertWordMatches(' ', ' ');
    }

    public function test_spaces(): void
    {
        // Spaces in Word should behave like regular non-reversible characters (?)
        self::assertWordMatches('ab cd ef', 'fe dc ba');
    }

    private static function assertWordMatches($expected, $input): void
    {
        $word = new Word($input);
        $anagram = $word->getAnagram();

        self::assertSame($expected, $anagram);
    }
}
