<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Anagram\Sentence;

echo (new Sentence('A1bcd efg!h'))->getReversed();
