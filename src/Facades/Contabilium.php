<?php

namespace SeinOxygen\Contabilium\Facades;

use Illuminate\Support\Facades\Facade;

class Contabilium extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Contabilium';
    }
}
