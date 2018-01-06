<?php

namespace AppBundle\Service;

class FileManagement
{
    public function getContents(string $fileName): string
    {
        if (file_exists($fileName)) {
            return file_get_contents($fileName);
        } else {
            $this->putContents($fileName, '');
            return '';
        }
    }

    public function putContents(string $fileName, string $data)
    {
        file_put_contents($fileName, $data);
    }
}
