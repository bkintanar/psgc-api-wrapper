<?php

namespace PSGC\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static self includes($includes = [])
 * @method static array|mixed get()
 * @method static array|mixed find($code)
 *
 * @see \PSGC\SubMunicipality
 */
class SubMunicipality extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \PSGC\SubMunicipality::class;
    }
}
