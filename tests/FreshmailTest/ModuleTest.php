<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 14:53
 */

namespace FreshmailTest;


use Freshmail\Module;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    /**
     * @var Module
     */
    private $moduleInstance;

    protected function setUp()
    {
        $this->moduleInstance = new Module();
    }

    public function testGetDependencies()
    {
        $dependencies = $this->moduleInstance->getDependencies();

        $this->assertArrayHasKey('factories', $dependencies);
    }

    public function testGetConfig()
    {
        $config = $this->moduleInstance->getConfig();

        $this->assertArrayHasKey('service_manager', $config);
    }
}
