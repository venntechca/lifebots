<?php

namespace LifeBots\Facades;

use Illuminate\Support\Facades\Facade;

class LifeBots extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LifeBots\LifeBots::class;
    }
}
