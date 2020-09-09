<?php

namespace Midun\Supports\Facades;

use Midun\Supports\Facade;

class Translator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'translator';
    }
}