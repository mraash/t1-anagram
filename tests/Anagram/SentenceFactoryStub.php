<?php

declare(strict_types=1);

namespace Tests\Anagram;

use App\Anagram\SentenceFactory;

class SentenceFactoryStub extends SentenceFactory
{
    public function create(string $input): SentenceStub
    {
        return new SentenceStub($input);
    }
}
