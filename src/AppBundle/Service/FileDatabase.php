<?php

namespace AppBundle\Service;

use AppBundle\Adapter\PhpAdapter;
use AppBundle\Entity\BaseEntity;

class FileDatabase
{
    private const FILE_NAME = '../database.json';
    private $phpAdapter;

    public function __construct(PhpAdapter $phpAdapter)
    {
        $this->phpAdapter = $phpAdapter;
    }

    public function addRecord(BaseEntity $entity): void
    {
        $records = $this->getAll();
        $entity->id = $this->phpAdapter->uniqueId();
        $records[] = (array)$entity;

        $this->writeArrayToFile($records);
    }

    private function writeArrayToFile(array $records): void
    {
        $this->phpAdapter->filePutContents(static::FILE_NAME, json_encode($records));
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
        $contents = $this->phpAdapter->fileGetContents(static::FILE_NAME);
        $decoded = json_decode($contents, true);

        if (is_null($decoded)) {
            // happens when file is empty
            return [];
        } else {
            // array values - so that indexes always be 0, 1, 2,...
            return array_values($decoded);
        }
    }

    /**
     * @param string $id
     * @param array $records - indexes has to be 0, 1, 2, ... - without gaps
     * @return int|null
     */
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
