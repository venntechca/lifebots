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

## Credits

- NealB for making LifeBots for Second Life
- Venkellie for making this package to work with LifeBots.

Last Update: June 1 2026 (0.0.2)