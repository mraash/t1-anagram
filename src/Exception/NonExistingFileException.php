<?php

declare(strict_types=1);

namespace App\Exception;

class NonExistingFileException extends CustomException
{
    private string $filename;

    public function __construct(string $filename)
    {
        parent::__construct("File \"{$filename}\" doesn't exist");
        $this->filename = $filename;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }
}
