<?php

namespace Infrastructure\Handlers;

use Exception;
use Illuminate\Support\Facades\File;

class JsonFileHandler extends FileHandler
{
    /**
     * @throws Exception
     */
    public function get()
    {
        $data = json_decode($this->contents, true);

        if (false === is_array($data)) {
            throw new Exception("Invalid JSON format.");
        }

        return $data;
    }
}
