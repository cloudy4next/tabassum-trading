<?php

namespace IceAxe\NativeCloud\App\Traits;

trait HelperTrait
{

    public function instanceCheck($instance, $class): bool
    {
        return $instance instanceof $class;
    }

}
