<?php

namespace Thetestcoder;

use InvalidArgumentException;
use Thetestcoder\Services\WeatherInterface;
use Thetestcoder\Services\Webhook;
use Thetestcoder\Services\WebhookInterface;

class WeatherAPIConsumer
{
    public function __construct(
        public WeatherInterface $weatherApi,
        public WebhookInterface $webhook
    )
    {
    }

    public function getCelsius()
    {
        $kelvin = $this->weatherApi->getCurrentTemperature();
        if (!is_numeric($kelvin)) {
            throw new InvalidArgumentException("Kelvin should be a number");
        }

        $celcius = $kelvin - 273.15;

        // push the data to webhook
        $this->webhook->push([
            'kelvin' => $kelvin,
            'celcius' => $celcius,
        ]);

        return round($celcius, 2);
    }
}