<?php

namespace Thetestcoder\Services;

interface WeatherInterface
{
    public function getCurrentTemperature(): float|int;
}