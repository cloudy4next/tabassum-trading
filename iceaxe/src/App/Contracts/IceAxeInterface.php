<?php

namespace IceAxe\NativeCloud\App\Contracts;


interface IceAxeInterface
{
    function initGrid();

    function filters();
    function listOperation();
    function createOperation();

    function initEdit($id, $actionRoute, $componentData = null);

    /**
     * @param mixed $id to find coresponding data of item.
     *
     * @return array should like this [componentName => componentData,etc...]
     */
    function setComponentData($id);
}
