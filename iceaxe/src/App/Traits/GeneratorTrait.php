<?php

namespace IceAxe\NativeCloud\App\Traits;

trait GeneratorTrait
{

    private array $params;

    public function __construct($params)
    {
        $this->params = $params;
    }


}
