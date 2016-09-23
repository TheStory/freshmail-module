<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 15:00
 */

namespace FreshmailTest\Service\Factory;


use Freshmail\Exception\InvalidConfigurationException;
use Freshmail\Model\Configuration;
use Freshmail\Service\Factory\ConfigurationFactory;
use Zend\ServiceManager\ServiceManager;

class ConfigurationFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigurationFactory
     */
    private $configurationServiceInstance;

    public function testCorrectConfiguration()
    {
        $configuration = $this->invokeFactory([
            'freshmail_module' => [
                'key' => 'key',
                'secret' => 'secret',
            ],
        ]);

        $this->assertInstanceOf(Configuration::class, $configuration);
        $this->assertEquals('key', $configuration->key);
        $this->assertEquals('secret', $configuration->secret);
    }

    private function invokeFactory($configuration)
    {
        return $this->configurationServiceInstance->__invoke($this->getServiceManagerStub($configuration), '');
    }

    private function getServiceManagerStub($configuration)
    {
        $stub = $this->createMock(ServiceManager::class);
        $stub->method('get')->willReturn($configuration);

        return $stub;
    }

    public function testMissingConfiguration()
    {
        try {
            $this->invokeFactory([]);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(InvalidConfigurationException::class, $exception);
            $this->assertEquals('Freshmail Module configuration not found', $exception->getMessage());
        }
    }

    public function testIncorrectConfiguration()
    {
        try {
            $this->invokeFactory([
                'freshmail_module' => [
                    'secret' => 'secret',
                ],
            ]);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(InvalidConfigurationException::class, $exception);
            $this->assertEquals('API key is required', $exception->getMessage());
        }

        try {
            $this->invokeFactory([
                'freshmail_module' => [
                    'key' => 'key',
                ],
            ]);
        } catch (\Exception $exception) {
            $this->assertInstanceOf(InvalidConfigurationException::class, $exception);
            $this->assertEquals('API secret is required', $exception->getMessage());
        }
    }

    protected function setUp()
    {
        $this->configurationServiceInstance = new ConfigurationFactory();
    }
}
