<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 17:22
 */

namespace Freshmail\Command\Campaign;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Campaign;

class Send extends AbstractCommand
{
    /**
     * @var Campaign
     */
    private $campaign;
    /**
     * @var \DateTime
     */
    private $sendDate;

    public function __construct(Campaign $campaign, \DateTime $sendDate = null)
    {
        $this->campaign = $campaign;
        $this->sendDate = $sendDate;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    public function getMethod()
    {
        return Send::METHOD_POST;
    }

    public function validate()
    {
        if (empty($this->campaign->getHash())) {
            $this->addErrorMessage('Provvided campaign has no hash specified');
        }
    }

    public function getPath()
    {
        return '/campaigns/send';
    }

    public function getData()
    {
        $data = [
            'hash' => $this->campaign->getHash(),
            'time' => $this->sendDate ? $this->sendDate->format('Y-m-d H:i:s') : null,
        ];

        return $this->filterOutEmptyData($data);
    }
}
