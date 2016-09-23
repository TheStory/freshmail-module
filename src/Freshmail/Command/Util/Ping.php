<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 18:30
 */

namespace Freshmail\Command\Util;


use Freshmail\Command\AbstractCommand;

class Ping extends AbstractCommand
{
    public function getMethod()
    {
        return self::METHOD_GET;
    }

    public function isValid()
    {
        return true;
    }

    public function getPath()
    {
        return '/ping';
    }
}