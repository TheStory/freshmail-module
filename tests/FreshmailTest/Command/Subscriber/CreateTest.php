<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:01
 */

namespace FreshmailTest\Command\Subscriber;


use Freshmail\Command\AbstractCommand;
use Freshmail\Command\Subscriber\Create;
use Freshmail\Model\Subscriber;
use Freshmail\Model\SubscriptionList;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{
    public function testConstructor()
    {
        $command = $this->getCommand();

        $this->assertInstanceOf(Subscriber::class, $command->getSubscriber());
    }

    /**
     * @return Create
     */
    private function getCommand()
    {
        return new Create($this->getSubscriber());
    }

    /**
     * @return Subscriber
     */
    private function getSubscriber()
    {
        $subscriptionList = new SubscriptionList();
        $subscriptionList->setHash('hash');

        $subscriber = new Subscriber();
        $subscriber->setEmail('test@email.com')
            ->setList($subscriptionList);

        return $subscriber;
    }

    public function testSetSubscriber()
    {
        $email = 'test2@email.com';

        $subscriber = $this->getSubscriber();
        $subscriber->setEmail($email);

        $command = $this->getCommand();
        $command->setSubscriber($subscriber);

        $this->assertInstanceOf(Subscriber::class, $command->getSubscriber());
        $this->assertEquals($email, $command->getSubscriber()->getEmail());
    }

    public function testGetMethod()
    {
        $this->assertEquals(AbstractCommand::METHOD_POST, $this->getCommand()->getMethod());
    }

    public function testGetData()
    {
        $data = $this->getCommand()->getData();

        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('list', $data);
        $this->assertArrayNotHasKey('state', $data);
    }

    public function testIsValid()
    {
        $command = $this->getCommand();

        $this->assertTrue($command->isValid());

        $command->setSubscriber(new Subscriber());

        $this->assertFalse($command->isValid());
        $this->assertTrue($command->hasErrors());
    }

    public function testGetPath()
    {
        $this->assertEquals('/subscriber/add', $this->getCommand()->getPath());
    }

    public function testGetErrorMessages()
    {
        $command = $this->getCommand();
        $command->setSubscriber(new Subscriber())->isValid();

        $this->assertTrue($command->hasErrors());
    }
}
