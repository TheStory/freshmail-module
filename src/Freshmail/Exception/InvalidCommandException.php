<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 17:54
 */

namespace Freshmail\Exception;


use Freshmail\Command\AbstractCommand;

class InvalidCommandException extends \Exception
{
    public $command;

    public function __construct(AbstractCommand $command)
    {
        parent::__construct('Command error');

        $this->command = $command;
    }
}