<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 17:46
 */

namespace FreshmailTest\Command\Subscriber;


use Freshmail\Command\Subscriber\Create;
use Freshmail\Command\Subscriber\Delete;
use Freshmail\Model\Subscriber;
use Freshmail\Model\SubscriptionList;
use FreshmailTest\FreshmailServiceAwareTest;

class DeleteTest extends FreshmailServiceAwareTest
{
    public function testConstructor()
    {
        $deleteCommand = new Delete(new Subscriber());

        $this->assertInstanceOf(Subscriber::class, $deleteCommand->getSubscriber());
    }

    public function testGetMethod()
    {
        $deleteCommand = new Delete(new Subscriber());

        $this->assertEquals(Delete::METHOD_POST, $deleteCommand->getMethod());
    }

    public function testValidate()
    {
        $subscriber = new Subscriber();
        $subscriber->setList(new SubscriptionList());

        $deleteCommand = new Delete($subscriber);

        $this->assertFalse($deleteCommand->isValid());
        $this->assertCount(2, $deleteCommand->getErrorMessages());
    }

    public function testGetPath()
    {
        $deleteCommand = new Delete(new Subscriber());

        $this->assertEquals('/subscriber/delete', $deleteCommand->getPath());
    }

    public function testGetData()
    {
        $list = new SubscriptionList();
        $list->setHash('hash');

        $subscriber = new Subscriber();
        $subscriber->setEmail('test@email.com')
            ->setList($list);

        $deleteCommand = new Delete($subscriber);
        $data = $deleteCommand->getData();

        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('list', $data);
    }

    public function testExecute()
    {
        $list = new SubscriptionList();
        $list->setHash($this->getEnvironmentVariable('TEST_LIST'));

        $subscriber = new Subscriber();
        $subscriber->setEmail($this->generateRandomEmail())
            ->setList($list);

        $createCommand = new Create($subscriber);
        $this->freshmail->executeCommand($createCommand);

        $deleteCommand = new Delete($subscriber);;
        $this->freshmail->executeCommand($deleteCommand);
    }
}