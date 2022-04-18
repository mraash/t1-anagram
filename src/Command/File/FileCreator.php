<?php

declare(strict_types=1);

namespace App\Command\File;

class FileCreator
{
    public function create(string $filename): File
    {
        return new File($filename);
    }
}
