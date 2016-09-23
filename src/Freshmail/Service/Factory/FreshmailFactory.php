<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 14:27
 */

namespace Freshmail\Service\Factory;


use Freshmail\Model\Configuration;
use Freshmail\Service\Freshmail;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class FreshmailFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $configuration = $container->get(Configuration::class);

        return new Freshmail($configuration);
    }
}