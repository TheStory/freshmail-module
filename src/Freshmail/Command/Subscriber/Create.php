<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 17:29
 */

namespace Freshmail\Command\Subscriber;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Subscriber;

class Create extends AbstractCommand
{
    /**
     * @var Subscriber
     */
    private $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * @return Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * @param Subscriber $subscriber
     * @return Create
     */
    public function setSubscriber($subscriber)
    {
        $this->subscriber = $subscriber;

        return $this;
    }

    public function getMethod()
    {
        return self::METHOD_POST;
    }

    public function getData()
    {
        $data = [
            'email' => $this->subscriber->getEmail(),
            'list' => $this->subscriber->getList()->getHash(),
            'state' => $this->subscriber->getState(),
            'confirm' => $this->subscriber->getConfirm() ? 1 : 0,
            'custom_fields' => $this->subscriber->getCustomFields(),
        ];

        return $this->filterOutEmptyData($data);
    }

    public function validate()
    {
        if (empty($this->subscriber->getEmail())) {
            $this->addErrorMessage('E-mail is required');
        }

        if (empty($this->subscriber->getList())) {
            $this->addErrorMessage('Subscription list is required');
        }
    }

    public function getPath()
    {
        return '/subscriber/add';
    }
}
