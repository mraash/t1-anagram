<?php

declare(strict_types=1);

namespace Tests\Command\File;

use PHPUnit\Framework\TestCase;
use App\Command\File\FileFactory;
use App\Exception\NonExistingFileException;

class FileFactoryTest extends TestCase
{
    public function testMainMethod(): void
    {
        $this->expectException(NonExistingFileException::class);
        (new FileFactory())->create('');
    }
}
