<?php

declare(strict_types=1);

namespace Tests\Command\File;

use App\Command\File\FileFactory;

class FileFactoryStub extends FileFactory
{
    public function create(string $filename): FileMock
    {
        return new FileMock($filename);
    }
}
