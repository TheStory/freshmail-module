<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:37
 */

namespace FreshmailTest\Command;


use Freshmail\Command\Util\Ping;
use PHPUnit\Framework\TestCase;

class AbstractCommandTest extends TestCase
{
    public function testGetErrorMessages()
    {
        $command = $this->getCommand();
        $command->addErrorMessage('Error message');

        $this->assertTrue(count($command->getErrorMessages()) > 0);
    }

    public function testGetData()
    {
        $this->assertNull($this->getCommand()->getData());
    }

    /**
     * @return Ping
     */
    private function getCommand()
    {
        $command = new Ping();

        return $command;
    }
}