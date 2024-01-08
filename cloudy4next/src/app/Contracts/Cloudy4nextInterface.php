<?php

namespace Cloudy4next\NativeCloud\App\Contracts;


interface Cloudy4nextInterface
{
    function initGrid();

    function filters();
    function listOperation();
    function createOperation();
}
