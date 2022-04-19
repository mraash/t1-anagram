<?php

declare(strict_types=1);

namespace Tests\Command\File;

use PHPUnit\Framework\TestCase;
use App\Command\File\FileCreator;
use App\Exception\NonExistingFileException;

class FileCreatorTest extends TestCase
{
    public function testMainMethod(): void
    {
        $this->expectException(NonExistingFileException::class);
        (new FileCreator())->create('');
    }
}
