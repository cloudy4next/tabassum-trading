<?php

namespace Cloudy4next\NativeCloud\Facades;

use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Cloudy4next
 * @method static createForm($createOperation)
 * @method static createGrid($listOperation, $setup, $CustomButton, $filters)
 */
class NativeCloudFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NativeCloudInterface::class;
    }
}
