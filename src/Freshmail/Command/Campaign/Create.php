<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 14:30
 */

namespace Freshmail\Command\Campaign;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Campaign;
use Freshmail\Model\ResponseAwareInterface;

class Create extends AbstractCommand implements ResponseAwareInterface
{
    /**
     * @var Campaign
     */
    private $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getMethod()
    {
        return AbstractCommand::METHOD_POST;
    }

    public function getPath()
    {
        return '/campaigns/create';
    }

    /**
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    public function validate()
    {
        $campaign = $this->campaign;

        if (empty($campaign->getName())) {
            $this->addErrorMessage('Name cannot be empty');
        }

        if (empty($campaign->getHtml())) {
            if (empty($campaign->getText())) {
                $this->addErrorMessage('HTML not provided. You must provide text or HTML content.');
            }
        }

        if (empty($campaign->getText())) {
            if (empty($campaign->getHtml())) {
                $this->addErrorMessage('Text not provided. You must provide text or HTML content.');
            }
        }

        if (!$campaign->getList() || empty($campaign->getList()->getHash())) {
            $this->addErrorMessage('No list hash provided');
        }
    }

    public function getData()
    {
        $campaign = $this->campaign;

        $data = [
            'name' => $campaign->getName(),
            'url' => $campaign->getUrl(),
            'html' => $campaign->getHtml(),
            'text' => $campaign->getText(),
            'subject' => $campaign->getSubject(),
            'from_address' => $campaign->getFromAddress(),
            'from_name' => $campaign->getFromName(),
            'reply_to' => $campaign->getReplyTo(),
            'list' => $campaign->getList()->getHash(),
            'group' => null,
            'resignlink' => $campaign->getResignLink(),
        ];

        return $this->filterOutEmptyData($data);
    }

    public function setResponse($response)
    {
        $this->campaign->setHash($response['data']['hash']);
    }
}
