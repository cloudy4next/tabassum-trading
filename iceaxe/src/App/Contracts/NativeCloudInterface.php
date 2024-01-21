<?php

namespace IceAxe\NativeCloud\App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface NativeCloudInterface
{
    function createGrid($columns, $data, $filters, $buttons): GridInterface;
    function getGrid(): GridInterface;

    function setSetup(Builder $model): Builder;
    function getForm(): FormInterface;
}
