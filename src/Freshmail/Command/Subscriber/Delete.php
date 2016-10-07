<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 07.10.2016
 * Time: 17:41
 */

namespace Freshmail\Command\Subscriber;


use Freshmail\Command\AbstractCommand;
use Freshmail\Model\Subscriber;
use Freshmail\Model\SubscriptionList;

class Delete extends AbstractCommand
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

    public function getMethod()
    {
        return Delete::METHOD_POST;
    }

    public function validate()
    {
        if (empty($this->subscriber->getEmail())) {
            $this->addErrorMessage('Subscriber has no e-mail address provided');
        }

        if (empty($this->subscriber->getList()->getHash())) {
            $this->addErrorMessage('Subscription list has no hash provided');
        }
    }

    public function getPath()
    {
        return '/subscriber/delete';
    }

    public function getData()
    {
        return [
            'email' => $this->subscriber->getEmail(),
            'list' => $this->subscriber->getList()->getHash(),
        ];
    }
}
