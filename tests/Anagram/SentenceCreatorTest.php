<?php

declare(strict_types=1);

namespace Tests\Anagram;

use PHPUnit\Framework\TestCase;
use App\Anagram\SentenceCreator;
use App\Anagram\Sentence;

class SentenceCreatorTest extends TestCase
{
    public function testMainMethod(): void
    {
        $sentence = (new SentenceCreator())->create('');
        $this->assertInstanceOf(Sentence::class, $sentence);
    }
}
