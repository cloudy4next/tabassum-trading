<?php

namespace IceAxe\NativeCloud\App\Contracts;


interface FormInterface
{
    function getColums();

    function setData(mixed $data);

    function setOperationType(String $operation);
    function setActionRoute(String $actionRoute);

    static function init(array $columns): self;

    function setComponentData($componentData);
}
