<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 22.09.2016
 * Time: 16:18
 */

namespace Freshmail\Service;


use Freshmail\Model\Configuration;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Json\Json;

class Freshmail
{
    const API_PREFIX = '/rest';
    const API_BACKEND = 'https://api.freshmail.com' . self::API_PREFIX;

    private $params;
    private $config;
    private $signature;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function get($path)
    {
        $this->request(Request::METHOD_GET, $path);
    }

    private function request($method, $path, $params = [])
    {
        $request = $this->getRequest($method, $path, $params);

        $httpClient = new Client();
        $httpClient
            ->setAdapter(Client\Adapter\Curl::class)
            ->send($request);
    }

    private function getRequest($method, $path, $params)
    {
        $this->setParams($params);
        $this->createSignature($path);

        $request = new Request();
        $request->setUri(self::API_BACKEND . $path)
            ->setMethod($method)
            ->getHeaders()
            ->addHeaderLine('Content-Type', 'application/json')
            ->addHeaderLine('X-Rest-ApiKey', $this->config->key)
            ->addHeaderLine('X-Rest-ApiSign', $this->signature);

        $request->setContent($this->params);

        return $request;
    }

    private function setParams($params)
    {
        if (count($params) > 0) {
            $this->params = Json::encode($params);
        }
    }

    private function createSignature($path)
    {
        $signatureData = sprintf(
            '%s%s%s%s%s',
            $this->config->key,
            self::API_PREFIX,
            $path,
            $this->params,
            $this->config->secret
        );

        $this->signature = sha1($signatureData);
    }

    public function post($path, $params = [])
    {
        $this->request(Request::METHOD_POST, $path, $params);
    }
}