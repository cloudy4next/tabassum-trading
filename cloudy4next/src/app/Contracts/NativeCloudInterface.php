<?php

namespace Cloudy4next\NativeCloud\App\Contracts;

use Illuminate\Http\Request;

interface NativeCloudInterface
{
    function createGrid($columns, $data, $filters, $buttons): GridInterface;
    function getGrid(): GridInterface;

    function getForm(): FormInterface;

}
