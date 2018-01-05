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
        $this->fileDatabase->addRecord($subscriber);
    }
}
