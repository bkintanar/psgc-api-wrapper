<?php

namespace PSGC\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self includes($includes = [])
 * @method static array|mixed get()
 * @method static array|mixed find($code)
 *
 * @see \PSGC\Municipality
 */
class Municipality extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PSGC\Municipality::class;
    }
}
