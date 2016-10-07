<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 16:09
 */

namespace FreshmailTest;


use Freshmail\Model\Campaign;
use Freshmail\Model\Configuration;
use Freshmail\Model\SubscriptionList;
use Freshmail\Service\Freshmail;
use PHPUnit\Framework\TestCase;

abstract class FreshmailServiceAwareTest extends TestCase
{
    /**
     * @var Freshmail
     */
    protected $freshmail;

    public function setUp()
    {
        $configuration = new Configuration();
        $configuration->key = $this->getEnvironmentVariable('API_KEY');
        $configuration->secret = $this->getEnvironmentVariable('API_SECRET');

        $this->freshmail = new Freshmail($configuration);
    }

    protected function getEnvironmentVariable($key)
    {
        if (!$value = getenv($key)) {
            throw new \Exception('Environment variable not found');
        }

        return $value;
    }

    protected function getValidCampaign()
    {
        $campaign = new Campaign();
        $campaign->setName('Name')
            ->setHtml('<p>HTML</p>')
            ->setText('Text')
            ->setReplyTo('test@test.com')
            ->setList((new SubscriptionList())->setHash(getenv('TEST_LIST') ?: null));

        return $campaign;
    }

    protected function generateRandomEmail()
    {
        return md5(time()) . '@email.com';
    }
}