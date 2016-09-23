<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:28
 */

namespace FreshmailTest\Exception;


use Freshmail\Command\Util\Ping;
use Freshmail\Exception\InvalidCommandException;
use PHPUnit\Framework\TestCase;

class InvalidCommandExceptionTest extends TestCase
{
    public function testConstructor()
    {
        $instance = new InvalidCommandException(new Ping());

        $this->assertInstanceOf(Ping::class, $instance->command);
        $this->assertEquals('Command error', $instance->getMessage());
    }
}