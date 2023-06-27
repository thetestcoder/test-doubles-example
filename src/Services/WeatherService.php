<?php

namespace Thetestcoder\Services;

class WeatherService implements WeatherInterface
{

    public function getCurrentTemperature(): float|int
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid=9f463a3837169d8c27b18bfd313c754e";

        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('GET', $url);

        $body = json_decode($response->getBody(), true);

        return $body['main']['temp'];
    }
}