<?php

namespace LifeBots;

use Illuminate\Support\Facades\Http;

class LifeBots
{

    public function __construct() {}

    protected function request(string $action, array $data = [])
    {
        $data['apikey'] = config('lifebots.api_key');
        $data['botname'] = config('lifebots.botname');
        $data['secret'] = config('lifebots.secret');
        $data['action'] = $action;
        $response = Http::post("https://api.lifebots.cloud/api/bot.html", $data);
        if ($response->ok()) {
            $api = $response->json();
            if (array_key_exists('result', $api) && $api['result'] == "OK") {
                return $api;
            }
        }
        return ['error' => 'Unable to connect'];
    }

    public function name2key(string $name)
    {
        $api = $this->request('name2key', ['name' => $name]);
        if (array_key_exists('error', $api)) {
            return "";
        }
        return $api['key'];
    }

    public function key2name(string $uuid)
    {
        $api = $this->request('key2name', ['key' => $uuid]);
        if (array_key_exists('error', $api)) {
            return "";
        }
        return $api['name'];
    }

    public function displayname(string $uuid)
    {
        $api = $this->request('getDisplayName', ['uuid' => $uuid]);
        if (array_key_exists('error', $api)) {
            return "";
        }
        return $api['displayName'];
    }

    public function getBotBalance()
    {
        $api = $this->request('get_balance', []);
        if (array_key_exists('error', $api)) {
            return "";
        }
        return $api['balance'];
    }

    public function getAvatarPic(string $uuid)
    {
        $api = $this->request('avatar_info', ['avatar' => $uuid]);
        if (array_key_exists('error', $api)) {
            return "";
        }
        return $api['image'];
    }
}
