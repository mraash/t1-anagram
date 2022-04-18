<?php

declare(strict_types=1);

namespace App\Command\File;

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

        /* @phpstan-ignore-next-line */
        return file_get_contents($this->filename);
    }

    protected function exists(): bool
    {
        return file_exists($this->filename);
    }

    protected function throwExceptionIfNotExists(): void
    {
        if (!$this->exists()) {
            throw new \Exception("File \"{$this->filename}\" doesn't exist");
        }
    }
}
