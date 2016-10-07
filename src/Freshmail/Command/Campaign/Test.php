<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 16:25
 */

namespace Freshmail\Command\Campaign;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Campaign;

class Test extends AbstractCommand
{
    /**
     * @var Campaign
     */
    private $campaign;
    /**
     * @var array
     */
    private $emails;
    /**
     * @var array
     */
    private $customFields;

    public function __construct(Campaign $campaign, array $emails, array $customFields = [])
    {
        $this->campaign = $campaign;
        $this->emails = $emails;
        $this->customFields = $customFields;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @return array
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    public function getMethod()
    {
        return Test::METHOD_POST;
    }

    public function validate()
    {
        if (empty($this->campaign->getHash())) {
            $this->addErrorMessage('No hash provided');
        }
    }

    public function getPath()
    {
        return '/campaigns/sendTest';
    }

    public function getData()
    {
        $data = [
            'hash' => $this->campaign->getHash(),
            'emails' => $this->emails,
            'custom_fields' => $this->customFields,
        ];

        return $this->filterOutEmptyData($data);
    }
}