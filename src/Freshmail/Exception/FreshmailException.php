<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 16:19
 */

namespace Freshmail\Exception;


use Exception;

class FreshmailException extends \Exception
{
    public $messages;

    public function __construct($code, array $messages)
    {
        parent::__construct('API respond with errors', $code);

        $this->messages = $messages;
    }
}