<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Subscriber;
use AppBundle\Service\FileDatabase;

class SubscriberRepository
{
    private $fileDatabase;

    public function __construct(FileDatabase $fileDatabase)
    {
        $this->fileDatabase = $fileDatabase;
    }

    public function save(Subscriber $subscriber): void
    {
        $subscriber->createdAt = date('Y-m-d');
        if ($subscriber->id) {
            $this->fileDatabase->updateRecord($subscriber);
        } else {
            $this->fileDatabase->addRecord($subscriber);
        }

    }

    public function getList(): array
    {
        return $this->fileDatabase->getAll();
    }

    public function findById(string $id):? array
    {
        return $this->fileDatabase->findById($id);
    }

    public function delete(string $id)
    {
        $this->fileDatabase->deleteRecord($id);
    }
}
