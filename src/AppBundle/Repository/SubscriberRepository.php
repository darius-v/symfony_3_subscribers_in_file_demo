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

    public function save(Subscriber $subscriber)
    {
        $subscriber->createdAt = date('Y-m-d');
        $this->fileDatabase->addRecord($subscriber);
    }

    public function getList()
    {
        return $this->fileDatabase->getAll();
    }
}
