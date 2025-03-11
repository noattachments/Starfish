<?php

namespace Infrastructure\Handlers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;

abstract class FileHandler
{
    protected string $path;
    protected string $contents;

    public function __construct(string $absoluteFilePath)
    {
        if (false === File::exists($this->path = $absoluteFilePath)) {
            throw new FileNotFoundException("Resource not found: $this->path");
        }

        $this->contents = File::get($this->path);
    }

    abstract public function get();
}
