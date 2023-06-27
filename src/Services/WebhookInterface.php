<?php

namespace Thetestcoder\Services;

interface WebhookInterface
{
    public function push(array $data = []): void;
}