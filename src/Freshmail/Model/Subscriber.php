<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 23.09.2016
 * Time: 17:30
 */

namespace Freshmail\Model;


use Freshmail\Exception\FieldValidationException;
use Zend\Validator\EmailAddress;

class Subscriber
{
    const STATE_ACTIVE = 1;
    const STATE_FOR_ACTIVATION = 2;
    const STATE_INACTIVE = 3;
    const STATE_UNSUBSCRIBED = 4;
    const STATE_BOUNCING_SOFT = 5;
    const STATE_BOUNCING_HARD = 6;

    private $email;
    private $list;
    private $state;
    private $confirm;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Subscriber
     * @throws FieldValidationException
     */
    public function setEmail($email)
    {
        if (!(new EmailAddress())->isValid($email)) {
            throw new FieldValidationException('E-mail in wrong format');
        }

        $this->email = $email;

        return $this;
    }

    /**
     * @return SubscriptionList
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param SubscriptionList $list
     * @return Subscriber
     */
    public function setList(SubscriptionList $list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     * @return Subscriber
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function getConfirm()
    {
        return $this->confirm == 1 ? true : false;
    }

    /**
     * @param bool $confirm
     * @return Subscriber
     * @throws FieldValidationException
     */
    public function setConfirm($confirm)
    {
        if (!is_bool($confirm)) {
            throw new FieldValidationException('Confirm state must be a boolean');
        }

        $this->confirm = $confirm == true ? 1 : 0;

        return $this;
    }
}
