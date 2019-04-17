<?php

namespace SkyBit\Socially\Facades;

use Illuminate\Support\Facades\Facade;

class Socially extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'socially';
    }
}