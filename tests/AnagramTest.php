<?php

declare(strict_types=1);

require_once __DIR__ . '/../functions/makeAnagram.php';

use PHPUnit\Framework\TestCase;

class AnagramTest extends TestCase
{
    public function test_typical_behavior(): void
    {
        $this->assertSame(makeAnagram('abc'), 'cba');
        $this->assertSame(makeAnagram('Word'), 'droW');
        $this->assertSame(makeAnagram('test'), 'tset');
    }

    public function test_input_with_non_reversible_characters(): void
    {
        $this->assertSame(makeAnagram('1abc23'), '1cba23');
        $this->assertSame(makeAnagram('Word!'), 'droW!');
        $this->assertSame(makeAnagram('test-1'), 'tset-1');
    }

    public function test_input_with_multiple_words(): void
    {
        $this->assertSame(makeAnagram('word1 word2 word3'), 'drow1 drow2 drow3');
    }

    public function test_input_with_multiple_spaces(): void
    {
        $this->assertSame(makeAnagram('two  spaces'), 'owt  secaps');
        $this->assertSame(makeAnagram('three   spaces'), 'eerht   secaps');
    }
}
