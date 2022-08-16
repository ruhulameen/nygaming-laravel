<?php

namespace Ruhul\NYGaming\Facades;

use Illuminate\Support\Facades\Facade;

class NewYorkGaming extends Facade
{
    /**
     * getFacadeAccessor
     *
     * @return void
     */
    protected static function getFacadeAccessor()
    {
        return 'newyorkgaming';
    }
}
