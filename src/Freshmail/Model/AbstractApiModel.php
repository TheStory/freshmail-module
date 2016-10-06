<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 13:59
 */

namespace Freshmail\Model;


use Freshmail\Exception\FieldValidationException;
use Zend\Validator\EmailAddress;
use Zend\Validator\Uri;

abstract class AbstractApiModel
{
    /**
     * @var SubscriptionList
     */
    protected $list;

    /**
     * @return SubscriptionList
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @param SubscriptionList $list
     * @return $this
     */
    public function setList(SubscriptionList $list)
    {
        $this->list = $list;

        return $this;
    }

    public function validateEmail($email)
    {
        if ($email == null) {
            return false;
        }

        if (!(new EmailAddress())->isValid($email)) {
            throw new FieldValidationException('E-mail in wrong format');
        }

        return true;
    }

    public  function validateUrl($url)
    {
        if ($url == null) {
            return false;
        }

        if (!(new Uri())->isValid($url)) {
            throw new FieldValidationException('URL in wrong format');
        }

        return true;
    }
}
