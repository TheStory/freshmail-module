<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 15:31
 */

namespace FreshmailTest\Model;


use Freshmail\Command\Subscriber\Create;
use Freshmail\Exception\FieldValidationException;
use Freshmail\Model\Subscriber;
use PHPUnit\Framework\TestCase;

class AbstractApiModelTest extends TestCase
{
    public function testValidateEmail()
    {
        $subscriber = new Subscriber();

        $this->assertFalse($subscriber->validateEmail(null));

        try {
            $subscriber->validateEmail('wrong email');
        } catch (\Exception $exception) {
            $this->assertInstanceOf(FieldValidationException::class, $exception);
        }

        $this->assertTrue($subscriber->validateEmail('test@email.com'));
    }

    public function testValidateUrl()
    {
        $subscriber = new Subscriber();

        $this->assertFalse($subscriber->validateUrl(null));

        try {
            $subscriber->validateUrl('wrong url');
        } catch (\Exception $exception) {
            $this->assertInstanceOf(FieldValidationException::class, $exception);
            $this->assertEquals('URL in wrong format', $exception->getMessage());
        }

        $this->assertTrue($subscriber->validateUrl('http://test.com'));
    }
}