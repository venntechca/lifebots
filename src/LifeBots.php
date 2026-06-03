<?php

namespace LifeBots;

use Illuminate\Support\Facades\Http;
use Str;
use Log;
class LifeBots
{
    public $NULL_KEY = "00000000-0000-0000-0000-000000000000";

    public function __construct() {}

    protected function request(string $action, array $data = [])
    {
        $data['apikey'] = config('lifebots.api_key');
        $data['botname'] = config('lifebots.botname');
        $data['secret'] = config('lifebots.secret');
        $data['action'] = $action;
        $data['dataType'] = 'json';
        $response = Http::acceptJson()->post("https://api.lifebots.cloud/api/bot.html", $data);
        if ($response->ok()) {
            $body = $response->body();
            $api = [];
            if (Str::isJson($body)) {
                $api = $response->json();
            }else{
                parse_str($body, $api);
            }
            if (array_key_exists("result", $api) && $api['result'] == "OK") {
                return $api;
            }else{
                return ["error" => $api];
            }
        }
        return ['error' => 'Unable to connect'];
    }

    public function name2key(string $name)
    {
        $api = $this->request('name2key', ['name' => $name]);
        if (array_key_exists('error', $api)) {
            return $this->$NULL_KEY;
        }
        return $api['key'];
    }

    public function key2name(string $uuid)
    {
        $api = $this->request('key2name', ['key' => $uuid]);
        if (array_key_exists('error', $api)) {
            return "Error";
        }
        return $api['name'];
    }

    public function displayname(string $uuid)
    {
        $api = $this->request('getDisplayName', ['uuid' => $uuid]);
        if (array_key_exists('error', $api)) {
            return "Error";
        }
        return $api['displayName'];
    }

    public function getBotBalance()
    {
        $api = $this->request('get_balance', []);
        if (array_key_exists('error', $api)) {
            return 0;
        }
        return $api['balance'];
    }

    public function getAvatarPic(string $uuid)
    {
        $api = $this->request('avatar_info', ['avatar' => $uuid]);
        if (array_key_exists('error', $api)) {
            return $this->$NULL_KEY;
        }
        return $api['image'];
    }
    public function sendim(string $user, string $msg) {
        $api = $this->request('im', ['slname' => $user, 'message' => $msg]);
        if (array_key_exists('error', $api)) {
            return false;
        }
        return true;
    }
    public function sendchanmsg(integer $chan, string $msg) {
        $api = $this->request('say_chat_channel', ['channel' => $chan, 'message' => $msg]);
        if (array_key_exists('error', $api)) {
            return false;
        }
        return true;
    }
    public function groupinvite(string $user, string $group, string $role, integer $check = 1) {
        $api = $this->request('group_invite', ['avatar' => $user, 'groupuuid' => $group, 
            'roleuuid' => $role, 'check_membership' => $check]);
        if (array_key_exists('error', $api)) {
            return false;
        }
        return true;
    }
    public function groupeject(string $user, string $group) {
        $api = $this->request('group_invite', ['avatar' => $user, 'groupuuid' => $group]);
        if (array_key_exists('error', $api)) {
            return false;
        }
        return true;
    }
}
