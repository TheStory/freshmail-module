<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 22.09.2016
 * Time: 16:18
 */

namespace Freshmail\Service;


use Freshmail\Command\AbstractCommand;
use Freshmail\Exception\FreshmailException;
use Freshmail\Exception\InvalidCommandException;
use Freshmail\Model\Configuration;
use Freshmail\Model\ResponseAwareInterface;
use Zend\Http\Client;
use Zend\Http\Exception\RuntimeException;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Json\Json;

class Freshmail
{
    const PATH_PREFIX = '/rest';
    const API_BACKEND = 'https://api.freshmail.com' . self::PATH_PREFIX;
    const STATUS_OK = 200;

    private $params;
    private $config;
    private $signature;

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function get($path)
    {
        return $this->request(Request::METHOD_GET, $path);
    }

    private function request($method, $path, $params = [])
    {
        $request = $this->getRequest($method, $path, $params);

        $httpClient = new Client();
        $response = $httpClient->setAdapter(Client\Adapter\Curl::class)
            ->send($request);

        $data = $this->getResponseData($response);

        return $data;
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
            self::PATH_PREFIX,
            $path,
            $this->params,
            $this->config->secret
        );

        $this->signature = sha1($signatureData);
    }

    private function getResponseData(Response $response)
    {
        $responseContent = $this->parseApiResponse($response);
        $statusCode = $response->getStatusCode();

        if ($statusCode != self::STATUS_OK) {
            if (isset($responseContent['errors'])) {
                throw new FreshmailException($statusCode, $responseContent['errors']);
            } else {
                throw new RuntimeException('Error response has no errors', $statusCode);
            }
        }

        if (isset($responseContent['status'])) {
            unset($responseContent['status']);
        }

        return $responseContent;
    }

    private function parseApiResponse(Response $response)
    {
        return Json::decode($response->getBody(), Json::TYPE_ARRAY);
    }

    public function post($path, $params = [])
    {
        return $this->request(Request::METHOD_POST, $path, $params);
    }

    public function executeCommand(AbstractCommand $command)
    {
        if (!$command->isValid()) {
            throw new InvalidCommandException($command);
        }

        if ($command->getMethod() == AbstractCommand::METHOD_GET) {
            $result = $this->get($command->getPath());
        } else {
            $result = $this->post($command->getPath(), $command->getData());
        }

        if ($command instanceof ResponseAwareInterface) {
            $command->setResponse($result);
        }

        return $result;
    }
}
