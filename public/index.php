<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Anagram\Sentence;

echo (new Sentence('A1bcd efg!h'))->getReversed();
