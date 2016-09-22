<?php
/**
 * Copyright: STORY DESIGN Sp. z o.o.
 * Author: Yaroslav Shatkevich
 * Date: 22.09.2016
 * Time: 16:21
 */

namespace FreshmailTest;


use Freshmail\Model\Configuration;
use Freshmail\Service\ApiService;
use PHPUnit\Framework\TestCase;

class ApiServiceTest extends TestCase
{
    public function testConstructor()
    {
        self::assertInstanceOf(ApiService::class, new ApiService(new Configuration()));
    }

    public function testRequest()
    {
        $configuration = new Configuration();
        $configuration->key = '22ad74ff7d6ba2bebe03994313c1e0f0';
        $configuration->secret = '1170c365700aad46d7d83fa8563f8fe0043be8cf';

        $apiService = new ApiService($configuration);

        $apiService->get('/ping');
        $apiService->post('/ping', ['ping' => 'pong']);
    }
}