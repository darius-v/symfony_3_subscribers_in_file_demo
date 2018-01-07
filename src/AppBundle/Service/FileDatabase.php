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

    public function addRecord(BaseEntity $entity): void
    {
        $records = $this->getAll();
        $entity->id = uniqid();
        $records[] = (array)$entity;
        $this->writeArrayToFile($records);
    }

    private function writeArrayToFile(array $records): void
    {
        $this->fileManagement->putContents(static::FILE_NAME, json_encode($records));
    }

    public function updateRecord(BaseEntity $entity): void
    {
        $records = $this->getAll();

        $position = $this->findPositionById($entity->id, $records);

        $records[$position] = (array)$entity;

        $this->writeArrayToFile($records);
    }

    public function deleteRecord(string $id)
    {
        $records = $this->getAll();
        $position = $this->findPositionById($id, $records);
        unset($records[$position]);
        $this->writeArrayToFile($records);
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

    private function findPositionById(string $id, array $records):? int
    {
        $recordIds = array_column($records, 'id');
        return array_search($id, $recordIds);
    }

    public function findById(string $id):? array
    {
        $records = $this->getAll();

        $position = $this->findPositionById($id, $records);

        if (is_null($position)) {
            return null;
        } else {
            return $records[$position];
        }
    }
}
