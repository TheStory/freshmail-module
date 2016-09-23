<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 17:34
 */

namespace Freshmail\Model;


class SubscriptionList
{
    private $hash;

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return SubscriptionList
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }
}