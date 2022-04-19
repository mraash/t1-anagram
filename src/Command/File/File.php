<?php

declare(strict_types=1);

namespace App\Command\File;

use App\Exception\NonExistingFileException;

class File
{
    protected string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;

        $this->throwExceptionIfNotExists();
    }

    public function getContent(): string
    {
        $this->throwExceptionIfNotExists();

        $content = file_get_contents($this->filename);

        if ($content === false) {
            throw new NonExistingFileException($this->filename);
        }

        return $content;
    }

    protected function exists(): bool
    {
        return file_exists($this->filename);
    }

    protected function throwExceptionIfNotExists(): void
    {
        if (!$this->exists()) {
            throw new NonExistingFileException($this->filename);
        }
    }
}
