<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Thetestcoder\Services\WeatherInterface;
use Thetestcoder\Services\WebhookInterface;
use Thetestcoder\WeatherAPIConsumer;

class WeatherAPIConsumerTest extends TestCase
{
    public ?WeatherInterface $weatherStub;
    public ?WebhookInterface $webhookMock;

    /**
     * @throws Exception
     */
    public function test_it_can_change_kelvin_to_celsius()
    {

        $this->weatherStub->method('getCurrentTemperature')
            ->willReturn(200);

        $weatherAPIConsumer = new WeatherAPIConsumer($this->weatherStub, $this->webhookMock);

        $this->assertEquals(-73.15, $weatherAPIConsumer->getCelsius());
    }

    public function test_it_should_be_called_once_when_get_the_celsius_data()
    {
        $this->weatherStub->method('getCurrentTemperature')
            ->willReturn(100);

        $this->webhookMock
            ->expects($this->once())
            ->method('push');

        $weatherAPIConsumer = new WeatherAPIConsumer($this->weatherStub, $this->webhookMock);
        $weatherAPIConsumer->getCelsius();

    }

    public function setUp(): void
    {
        $this->weatherStub = $this->createStub(WeatherInterface::class);
        $this->webhookMock = $this->createMock(WebhookInterface::class);
    }

    public function tearDown(): void
    {
        $this->weatherStub = null;
        $this->webhookMock = null;
    }
}