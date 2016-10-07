<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 16:31
 */

namespace Freshmail\Model;


interface ResponseAwareInterface
{
    public function setResponse($response);
}