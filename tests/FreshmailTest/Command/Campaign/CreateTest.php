<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 15:01
 */

namespace FreshmailTest\Command\Campaign;


use Freshmail\Command\Campaign\Create;
use Freshmail\Command\Campaign\Delete;
use Freshmail\Model\Campaign;
use Freshmail\Model\SubscriptionList;
use FreshmailTest\FreshmailServiceAwareTest;

class CreateTest extends FreshmailServiceAwareTest
{
    public function testConstructor()
    {
        $command = $this->getNewCampaignCommand();

        $this->assertInstanceOf(Create::class, $command);
        $this->assertInstanceOf(Campaign::class, $command->getCampaign());
    }

    /**
     * @return Create
     */
    protected function getNewCampaignCommand()
    {
        $campaign = new Campaign();
        $command = new Create($campaign);

        return $command;
    }

    public function testGetMethod()
    {
        $command = $this->getNewCampaignCommand();

        $this->assertEquals(Create::METHOD_POST, $command->getMethod());
    }

    public function testGetPath()
    {
        $command = $this->getNewCampaignCommand();

        $this->assertEquals('/campaigns/create', $command->getPath());
    }

    public function testValidate()
    {
        $command = $this->getNewCampaignCommand();
        $campaign = $command->getCampaign();

        $command->validate();

        $this->assertCount(4, $command->getErrorMessages());

        $campaign->setName('Name');

        $command->resetErrors();
        $command->validate();

        $this->assertCount(3, $command->getErrorMessages());

        $campaign->setHtml('<p>HTML</p>');

        $command->resetErrors();
        $command->validate();

        $this->assertCount(1, $command->getErrorMessages());

        $campaign->setHtml(null)
            ->setText('Text');

        $command->resetErrors();
        $command->validate();

        $campaign->setHtml('<p>HTML</p>');

        $command->resetErrors();
        $command->validate();

        $this->assertCount(1, $command->getErrorMessages());

        $campaign->setList(new SubscriptionList());

        $command->resetErrors();
        $command->validate();

        $this->assertCount(1, $command->getErrorMessages());


        $campaign->setList((new SubscriptionList())->setHash('hash'));

        $command->resetErrors();
        $command->validate();

        $this->assertCount(0, $command->getErrorMessages());
    }

    public function testGetData()
    {
        $command = new Create($this->getValidCampaign());

        $data = $command->getData();

        $this->assertTrue(is_array($data));
        $this->assertCount(5, $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('html', $data);
        $this->assertArrayHasKey('text', $data);
        $this->assertArrayHasKey('list', $data);
        $this->assertArrayHasKey('reply_to', $data);
    }

    public function testExecute()
    {
        $freshmail = $this->freshmail;
        $createCommand = new Create($this->getValidCampaign());

        $freshmail->executeCommand($createCommand);

        $this->assertNotEmpty($createCommand->getCampaign()->getHash());

        $deleteCommand = new Delete($createCommand->getCampaign());
        $freshmail->executeCommand($deleteCommand);
    }
}