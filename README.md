# LifeBots Laravel SDK

A lightweight, expressive Laravel package for interacting with the **LifeBots.cloud API**.  
Provides a clean API client, optional Facade, and full Laravel auto‑discovery with publishable configuration.

---

## Installation

Install via Composer:

```bash
composer require venntechca/lifebots
```

Then to get the config via Artisan

```bash
php artisan vendor:publish --tag=lifebots
```

Env config varables are
```env
LIFEBOTS_API_KEY=
LIFEBOTS_BOT_NAME=
LIFEBOTS_SECRET=
```
API_KEY is the developer key, once you get a life bot account theres a option to be a developer.

BOT_NAME is the name of your bot, their legacy/login name, NOT their display name.

SECRET is the secret password you set in your bot's web config.

## Usage
```php
$name = LifeBots::key2name($uuid); // returns Error if failed
$key = LifeBots::name2key($name); // returns nullkey if failed
$displayName = LifeBots::displayname($uuid); // returns Error if failed
$botBalance = LifeBots::getBotBalance(); // returns a zero if failed
$avatarPic = LifeBots::getAvatarPic($uuid); // returns a nullkey if failed
LifeBots::sendim($legacyname, $message); // returns true if sent, false otherwise
LifeBots::sendchanmsg($channel, $message); // same as this one
LifeBots::groupinvite(string $user, string $group, string $role, integer $check = 1); // returns true|false
LifeBots::groupeject(string $user, string $group); // returns true|false
```
getAvatarPic() returns the UUID of the texture in the avatar's profile picture.
Please use a processor to get the texture from SL to display on a web page

More features will come in a future update.

## Credits

- NealB for making LifeBots for Second Life
- Venkellie for making this package to work with LifeBots.

Last Update: June 3 2026 (1.0.3)

## CHANGE LOGS

### 1.0.3 June 3 2026
- Added groupinvite and groupeject
- Started recording these change logs

### 1.0.2a June 2 2026
- fix a issue where the endpoint was returning a query string instead of json

### 1.0.2 June 2 2026
- added sendim and sendchanmsg

### 1.0.1 June 1 2026
- inital release with some basic functions.
