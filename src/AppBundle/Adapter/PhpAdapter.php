<?php

namespace AppBundle\Adapter;

class PhpAdapter
{
    public function fileGetContents(string $fileName): string
    {
        return file_get_contents($fileName);
    }

    public function filePutContents(string $fileName, string $data)
    {
        file_put_contents($fileName, $data);
    }

    public function uniqueId()
    {
        return uniqid();
    }
}
