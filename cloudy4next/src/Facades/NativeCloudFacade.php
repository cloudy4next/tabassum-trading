<?php

namespace Cloudy4next\NativeCloud\Facades;

use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Cloudy4next
 */
class NativeCloudFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NativeCloudInterface::class;
    }
}
