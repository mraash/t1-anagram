<?php

declare(strict_types=1);

namespace Tests\Command\File;

use App\Command\File\FileCreator;

class FileCreatorStub extends FileCreator
{
    public function create(string $filename): FileMock
    {
        return new FileMock($filename);
    }
}
