<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 16:30
 */

namespace Freshmail\Command\Campaign;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Campaign;

class Delete extends AbstractCommand
{
    /**
     * @var Campaign
     */
    private $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    public function getMethod()
    {
        return Delete::METHOD_POST;
    }

    public function validate()
    {
        if (empty($this->campaign->getHash())) {
            $this->addErrorMessage('Cannot delete campaign without hash');
        }
    }

    public function getPath()
    {
        return '/campaigns/delete';
    }

    public function getData()
    {
        return [
            'hash' => $this->campaign->getHash(),
        ];
    }
}
