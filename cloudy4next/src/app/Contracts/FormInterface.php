<?php

namespace Cloudy4next\NativeCloud\App\Contracts;


interface FormInterface
{
    function getColums();

    function setOperationType(String $operation);

    static function init(array $columns): self;

    // function getActionMethod();
}
