<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 15:28
 */

namespace FreshmailTest\Service\Factory;


use Freshmail\Model\Configuration;
use Freshmail\Service\Factory\FreshmailFactory;
use Freshmail\Service\Freshmail;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;

class FreshmailFactoryTest extends TestCase
{
    public function testFactory()
    {
        $configuration = new Configuration();
        $configuration->key = 'key';
        $configuration->secret = 'secret';

        $configurationStub = $this->createMock(ServiceManager::class);
        $configurationStub->method('get')->willReturn($configuration);

        $factoryInstance = new FreshmailFactory();
        $service = $factoryInstance->__invoke($configurationStub, '');

        $this->assertInstanceOf(Freshmail::class, $service);
    }
}
