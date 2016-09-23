<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 19:01
 */

namespace FreshmailTest\Model;


use Freshmail\Model\SubscriptionList;
use PHPUnit\Framework\TestCase;

class SubscriptionListTest extends TestCase
{
    public function testHashSetterAndGetter()
    {
        $subscriptionList = new SubscriptionList();
        $result = $subscriptionList->setHash('hash');

        $this->assertInstanceOf(SubscriptionList::class, $result);
        $this->assertEquals('hash', $result->getHash());
    }
}