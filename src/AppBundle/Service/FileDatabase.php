<?php

namespace AppBundle\Service;

use AppBundle\Entity\BaseEntity;

class FileDatabase
{
    private const FILE_NAME = '../database.json';
    private $fileManagement;

    public function __construct(FileManagement $fileManagement)
    {
        $this->fileManagement = $fileManagement;
    }

    public function addRecord(BaseEntity $entity)
    {
        $contents = $this->getAll();
        $entity->id = uniqid();
        $contents[] = (array)$entity;
        $this->fileManagement->putContents(static::FILE_NAME, json_encode($contents));
    }

    public function getAll(): array
    {
        $contents = $this->fileManagement->getContents(static::FILE_NAME);
        $decoded = json_decode($contents, true);

        if (is_null($decoded)) {
            // happens when file is empty
            return [];
        } else {
            return $decoded;
        }
    }
}
