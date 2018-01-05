<?php

namespace AppBundle\Service;

use AppBundle\Entity\BaseEntity;

class FileDatabase
{
    private $fileManagement;

    public function __construct(FileManagement $fileManagement)
    {
        $this->fileManagement = $fileManagement;
    }

    public function addRecord(BaseEntity $entity)
    {
        $fileName = '../database.json';
        $contents = $this->fileManagement->getContents($fileName);
        $contents = json_decode($contents, true);
        $entity->id = uniqid();
        $contents[] = (array)$entity;
        $this->fileManagement->putContents($fileName, json_encode($contents));
    }
}
