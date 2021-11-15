<?php

namespace App\Support;

use Illuminate\Support\Facades\Facade;

class BunnyCdnFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cdnlibrary';
    }
}