<?php

namespace Thetestcoder\Services;

class Webhook implements WebhookInterface
{

    public function push(array $data = []): void
    {
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $response = $client->request('POST', 'https://webhook.site/3c560731-fd43-4cd6-9374-338d072ada82', [
            'json' => [
                'name' => 'deep',
                'time' => time(),
                ...$data
            ],
        ]);
    }
}