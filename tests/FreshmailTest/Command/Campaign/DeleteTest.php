<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 16:33
 */

namespace FreshmailTest\Command\Campaign;


use Freshmail\Command\Campaign\Create;
use Freshmail\Command\Campaign\Delete;
use Freshmail\Model\Campaign;
use FreshmailTest\FreshmailServiceAwareTest;

class DeleteTest extends FreshmailServiceAwareTest
{
    public function testConstructor()
    {
        $deleteCommand = new Delete(new Campaign());

        $this->assertInstanceOf(Campaign::class, $deleteCommand->getCampaign());
    }

    public function testExecute()
    {
        $campaign = $this->getValidCampaign();

        $createCommand = new Create($campaign);
        $this->freshmail->executeCommand($createCommand);

        $deleteCommand = new Delete($campaign);
        $this->freshmail->executeCommand($deleteCommand);
    }

    public function testValidate()
    {
        $deleteCommand = new Delete(new Campaign());

        $this->assertFalse($deleteCommand->isValid());
        $this->assertCount(1, $deleteCommand->getErrorMessages());
    }
}