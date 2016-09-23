<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 16:25
 */

namespace FreshmailTest\Exception;


use Freshmail\Exception\FreshmailException;
use PHPUnit\Framework\TestCase;

class FreshmailExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $error1 = ['code' => 200, 'message' => 'Message 1'];
        $error2 = ['code' => 500, 'message' => 'Message 2'];

        $instance = new FreshmailException(200, [$error1, $error2]);

        $this->assertEquals(200, $instance->getCode());
        $this->assertEquals('API respond with errors', $instance->getMessage());
        $this->assertTrue(is_array($instance->messages), 'Provided error messages must be an array');
        $this->assertEquals($error1, $instance->messages[0]);
        $this->assertEquals($error2, $instance->messages[1]);
    }
}