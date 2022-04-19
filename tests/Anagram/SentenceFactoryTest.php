<?php

declare(strict_types=1);

namespace Tests\Anagram;

use PHPUnit\Framework\TestCase;
use App\Anagram\SentenceFactory;
use App\Anagram\Sentence;

class SentenceFactoryTest extends TestCase
{
    public function testMainMethod(): void
    {
        $sentence = (new SentenceFactory())->create('');
        $this->assertInstanceOf(Sentence::class, $sentence);
    }
}
