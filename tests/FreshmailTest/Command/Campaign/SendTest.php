<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 17:29
 */

namespace FreshmailTest\Command\Campaign;


use Freshmail\Command\Campaign\Create;
use Freshmail\Command\Campaign\Send;
use Freshmail\Model\Campaign;
use FreshmailTest\FreshmailServiceAwareTest;

class SendTest extends FreshmailServiceAwareTest
{
    public function testConstructor()
    {
        $sendCommand = new Send(new Campaign(), new \DateTime());

        $this->assertInstanceOf(Campaign::class, $sendCommand->getCampaign());
        $this->assertInstanceOf(\DateTime::class, $sendCommand->getSendDate());
    }

    public function testGetMethod()
    {
        $sendCommand = new Send(new Campaign());

        $this->assertEquals(Send::METHOD_POST, $sendCommand->getMethod());
    }

    public function testValidate()
    {
        $sendCommand = new Send(new Campaign());

        $this->assertFalse($sendCommand->isValid());
    }

    public function testGetPath()
    {
        $sendCommand = new Send(new Campaign());

        $this->assertEquals('/campaigns/send', $sendCommand->getPath());
    }

    public function testGetData()
    {
        $campaign = $this->getValidCampaign();
        $campaign->setHash('hash');

        $sendCommand = new Send($campaign, new \DateTime());
        $data = $sendCommand->getData();

        $this->assertArrayHasKey('hash', $data);
        $this->assertArrayHasKey('time', $data);

        $sendCommand = new Send($campaign);
        $this->assertArrayNotHasKey('time', $sendCommand->getData());
    }

    public function testExecute()
    {
        $campaign = $this->getValidCampaign();

        $createCommand = new Create($campaign);
        $this->freshmail->executeCommand($createCommand);

        $sendCommand = new Send($campaign);
        $this->freshmail->executeCommand($sendCommand);
    }
}
