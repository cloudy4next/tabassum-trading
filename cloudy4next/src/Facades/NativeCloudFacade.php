<?php

namespace Cloudy4next\NativeCloud\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cloudy4next
 */
class NativeCloudFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "native-cloud";
    }
}
