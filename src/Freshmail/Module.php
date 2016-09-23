<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 14:24
 */

namespace Freshmail;


use Freshmail\Model\Configuration;
use Freshmail\Service\Factory\ConfigurationFactory;
use Freshmail\Service\Freshmail;
use Freshmail\Service\Factory\FreshmailFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getDependencies()
    {
        return [
            'factories' => [
                Configuration::class => ConfigurationFactory::class,
                Freshmail::class => FreshmailFactory::class,
            ],
        ];
    }

    public function getConfig()
    {
        return [
            'service_manager' => $this->getDependencies(),
        ];
    }
}