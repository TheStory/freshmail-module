<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 17:26
 */

namespace Freshmail\Command;


abstract class AbstractCommand
{
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';

    private $data;
    private $errorMessages = [];

    public function resetErrors()
    {
        $this->errorMessages = [];

        return $this;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }

    public function addErrorMessage($message)
    {
        $this->errorMessages[] = $message;
    }

    abstract public function getMethod();

    public function isValid()
    {
        $this->validate();

        return !$this->hasErrors();
    }

    abstract public function validate();

    abstract public function getPath();

    public function getData()
    {
        return $this->data;
    }

    public function hasErrors()
    {
        return count($this->errorMessages) > 0;
    }

    protected function filterOutEmptyData($data)
    {
        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }
}
