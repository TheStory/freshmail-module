<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 15:45
 */

namespace FreshmailTest\Model;


use Freshmail\Model\Campaign;
use PHPUnit\Framework\TestCase;

class CampaignTest extends TestCase
{
    public function testSetUrl()
    {
        $url = 'http://test.com';
        $campaign = new Campaign();
        $campaign->setUrl($url);

        $this->assertEquals($url, $campaign->getUrl());
    }

    public function testSetSubject()
    {
        $subject = 'Subject';
        $campaign = new Campaign();
        $campaign->setSubject($subject);

        $this->assertEquals($subject, $campaign->getSubject());
    }

    public function testSetFromAddress()
    {
        $email = 'test@email.com';
        $campaign = new Campaign();
        $campaign->setFromAddress($email);

        $this->assertEquals($email, $campaign->getFromAddress());
    }

    public function testSetFromName()
    {
        $name = 'Name';
        $campaign = new Campaign();
        $campaign->setFromName($name);

        $this->assertEquals($name, $campaign->getFromName());
    }

    public function testSetReplyTo()
    {
        $email = 'test@email.com';
        $campaign = new Campaign();
        $campaign->setReplyTo($email);

        $this->assertEquals($email, $campaign->getReplyTo());
    }

    public function testSetResignLink()
    {
        $url = 'http://test.com';
        $campaign = new Campaign();
        $campaign->setResignLink($url);

        $this->assertEquals($url, $campaign->getResignLink());
    }
}