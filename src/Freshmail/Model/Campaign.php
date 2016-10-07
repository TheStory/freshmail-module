<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 06.10.2016
 * Time: 13:52
 */

namespace Freshmail\Model;


class Campaign extends AbstractApiModel
{
    private $hash;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $html;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $fromAddress;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $replyTo;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $resignLink;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Campaign
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Campaign
     */
    public function setUrl($url)
    {
        $this->validateUrl($url);

        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html
     * @return Campaign
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Campaign
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Campaign
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * @param string $fromAddress
     * @return Campaign
     */
    public function setFromAddress($fromAddress)
    {
        $this->validateEmail($fromAddress);

        $this->fromAddress = $fromAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     * @return Campaign
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param string $replyTo
     * @return Campaign
     */
    public function setReplyTo($replyTo)
    {
        $this->validateEmail($replyTo);

        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getResignLink()
    {
        return $this->resignLink;
    }

    /**
     * @param string $resignLink
     * @return Campaign
     */
    public function setResignLink($resignLink)
    {
        $this->validateUrl($resignLink);

        $this->resignLink = $resignLink;

        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Campaign
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }
}
