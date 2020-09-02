<?php

namespace Eyadh\MyFirstPackage\Facades;

use Illuminate\Support\Facades\Facade;

class BadgeProvider extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Eyadh\MyFirstPackage\BadgeProvider::class;
    }
}
