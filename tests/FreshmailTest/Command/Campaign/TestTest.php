<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 16:45
 */

namespace FreshmailTest\Command\Campaign;


use Freshmail\Command\Campaign\Create;
use Freshmail\Command\Campaign\Delete;
use Freshmail\Command\Campaign\Test;
use Freshmail\Model\Campaign;
use FreshmailTest\FreshmailServiceAwareTest;

class TestTest extends FreshmailServiceAwareTest
{
    public function testConstructor()
    {
        $command = new Test(new Campaign(), ['email@email.com'], ['field' => 'value']);

        $this->assertInstanceOf(Campaign::class, $command->getCampaign());
        $this->assertTrue(is_array($command->getEmails()));
        $this->assertTrue(is_array($command->getCustomFields()));
        $this->assertArraySubset(['email@email.com'], $command->getEmails());
        $this->assertArrayHasKey('field', $command->getCustomFields());
    }

    public function testExecute()
    {
        $campaign = $this->getValidCampaign();

        $createCampaignCommand = new Create($campaign);
        $this->freshmail->executeCommand($createCampaignCommand);

        $command = new Test($campaign, [$this->getEnvironmentVariable('TEST_EMAIL')]);
        $this->freshmail->executeCommand($command);

        $this->assertNotNull($campaign->getHash());

        $deleteCommand = new Delete($campaign);
        $this->freshmail->executeCommand($deleteCommand);
    }

    public function testValidate()
    {
        $testCommand = new Test(new Campaign(), [], []);

        $this->assertFalse($testCommand->isValid());
        $this->assertCount(1, $testCommand->getErrorMessages());
    }
}