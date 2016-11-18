<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:42
 */

namespace FreshmailTest\Model;


use Freshmail\Exception\FieldValidationException;
use Freshmail\Model\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberTest extends TestCase
{
    public function testSetEmail()
    {
        $email = 'test@email.com';

        $subscriber = $this->getSubscriber();
        $subscriber->setEmail($email);

        $this->assertEquals($email, $subscriber->getEmail());

        try {
            $subscriber->setEmail('wrong_email');
        } catch (\Exception $exception) {
            $this->assertInstanceOf(FieldValidationException::class, $exception);
            $this->assertEquals('E-mail in wrong format', $exception->getMessage());
        }
    }

    public function testStateGetterAndSetter()
    {
        $subscriber = $this->getSubscriber();
        $result = $subscriber->setState(Subscriber::STATE_BOUNCING_HARD);

        $this->assertInstanceOf(Subscriber::class, $result);
        $this->assertEquals(Subscriber::STATE_BOUNCING_HARD, $subscriber->getState());
    }

    public function testConfirmGetterAndSetter()
    {
        $subscriber = $this->getSubscriber();
        $result = $subscriber->setConfirm(true);

        $this->assertInstanceOf(Subscriber::class, $result);
        $this->assertTrue($subscriber->getConfirm());

        try {
            $subscriber->setConfirm('wrong_state');
        } catch (\Exception $exception) {
            $this->assertInstanceOf(FieldValidationException::class, $exception);
            $this->assertEquals('Confirm state must be a boolean', $exception->getMessage());
        }
    }

    public function testSetCustomFields()
    {
        $subscriber = $this->getSubscriber();
        $subscriber->setCustomFields(['test' => 'test']);

        $this->assertArrayHasKey('test', $subscriber->getCustomFields());

        $this->expectException(FieldValidationException::class);
        $subscriber->setCustomFields('wrong_custom_field_value');
    }

    /**
     * @return Subscriber
     */
    private function getSubscriber()
    {
        $subscriber = new Subscriber();

        return $subscriber;
    }
}