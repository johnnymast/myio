<?php

namespace App\Session;

use Illuminate\Support\Facades\Facade;

class Flash extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flash';
    }
}