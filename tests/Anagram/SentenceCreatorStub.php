<?php

declare(strict_types=1);

namespace Tests\Anagram;

use App\Anagram\SentenceCreator;

class SentenceCreatorStub extends SentenceCreator
{
    public function create(string $input): SentenceStub
    {
        return new SentenceStub($input);
    }
}
