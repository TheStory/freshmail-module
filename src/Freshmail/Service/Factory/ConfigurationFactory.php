<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 14:29
 */

namespace Freshmail\Service\Factory;


use Freshmail\Exception\InvalidConfigurationException;
use Freshmail\Model\Configuration;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ConfigurationFactory implements FactoryInterface
{
    const CONFIG_KEY = 'freshmail_module';

    /**
     * @var ContainerInterface
     */
    private $container;
    private $applicationConfiguration;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->initFactory($container);

        return $this->getConfiguration();
    }

    private function initFactory(ContainerInterface $container)
    {
        $this->container = $container;
        $this->applicationConfiguration = $this->container->get('config');
    }

    private function getConfiguration()
    {
        $config = $this->getRawConfiguration();

        $configuration = new Configuration();
        $configuration->key = $config['key'];
        $configuration->secret = $config['secret'];

        return $configuration;
    }

    private function getRawConfiguration()
    {
        $this->validateConfiguration();

        return $this->applicationConfiguration[self::CONFIG_KEY];
    }

    private function validateConfiguration()
    {
        $config = $this->applicationConfiguration;

        if (!isset($config[self::CONFIG_KEY])) {
            throw new InvalidConfigurationException('Freshmail Module configuration not found');
        }

        if (!isset($config[self::CONFIG_KEY]['key'])) {
            throw new InvalidConfigurationException('API key is required');
        }

        if (!isset($config[self::CONFIG_KEY]['secret'])) {
            throw new InvalidConfigurationException('API secret is required');
        }
    }
}
