<?php

namespace AppBundle\Service;

use AppBundle\Adapter\PhpAdapter;
use AppBundle\Entity\Subscriber;
use PHPUnit\Framework\TestCase;

class FileDatabaseTest extends TestCase
{
    public function testAddRecordAddsCorrectRecord()
    {
        $expectedFileContents
            = '[{"id":"uniqueId","name":"name","email":"a@b.lt","categories":["Sports"],"createdAt":"2018-01-01"}]';

        $mock = $this->getMockBuilder(PhpAdapter::class)
            ->setMethods(['uniqueId', 'filePutContents', 'fileGetContents'])
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('uniqueId')
            ->willReturn('uniqueId');

        $mock
            ->expects($this->once())
            ->method('filePutContents')
            ->with('../database.json', $expectedFileContents);

        $fileDatabase = new FileDatabase($mock);

        $subscriber = new Subscriber();

        $subscriber->categories = ['Sports'];
        $subscriber->email = 'a@b.lt';
        $subscriber->name = 'name';
        $subscriber->createdAt = '2018-01-01';

        $fileDatabase->addRecord($subscriber);
    }
}
