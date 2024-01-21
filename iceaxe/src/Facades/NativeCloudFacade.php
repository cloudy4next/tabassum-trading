<?php

namespace IceAxe\NativeCloud\Facades;

use IceAxe\NativeCloud\App\Contracts\NativeCloudInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @see \IceAxe
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
