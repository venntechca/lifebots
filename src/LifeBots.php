<?php

namespace LifeBots;

use Illuminate\Support\Facades\Http;

class LifeBots
{
    protected string $apiKey;
    protected string $baseUrl;

    public function __construct(string $apiKey, string $baseUrl)
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    protected function request(string $method, string $endpoint, array $data = [])
    {
        return Http::withToken($this->apiKey)
            ->$method("{$this->baseUrl}/{$endpoint}", $data)
            ->json();
    }

    public function bots()
    {
        return $this->request('get', 'bots');
    }

    public function bot(string $id)
    {
        return $this->request('get', "bots/{$id}");
    }
}
