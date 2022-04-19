<?php

declare(strict_types=1);

namespace App\Command\File;

class FileFactory
{
    public function create(string $filename): File
    {
        return new File($filename);
    }
}
