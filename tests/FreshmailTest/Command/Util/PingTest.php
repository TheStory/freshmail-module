<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:34
 */

namespace FreshmailTest\Command\Util;


use Freshmail\Command\Util\Ping;
use PHPUnit\Framework\TestCase;

class PingTest extends TestCase
{
    public function testGetMethod()
    {
        $this->assertEquals(Ping::METHOD_GET, $this->getCommand()->getMethod());
    }

    /**
     * @return Ping
     */
    private function getCommand()
    {
        $command = new Ping();

        return $command;
    }

    public function testIsValid()
    {
        $this->assertTrue($this->getCommand()->isValid());
    }

    public function testGetPath()
    {
        $this->assertEquals('/ping', $this->getCommand()->getPath());
    }
}