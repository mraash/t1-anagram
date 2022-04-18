<?php

declare(strict_types=1);

namespace Tests\Command\File;

use App\Command\File\File;

class FileMock extends File
{
    private array $files = [
        'myfile.txt' => 'string from file',
    ];

    public function getContent(): string
    {
        $this->throwExceptionIfNotExists();

        return $this->files[$this->filename];
    }

    protected function exists(): bool
    {
        return isset($this->files[$this->filename]);
    }
}
