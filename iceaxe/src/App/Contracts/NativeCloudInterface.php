<?php

namespace IceAxe\NativeCloud\App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface NativeCloudInterface
{
    function createGrid($columns, $filters, $buttons): GridInterface;
    function getGrid(): GridInterface;
    function setSetup(Builder $model): Builder;
    function getForm(): FormInterface;
    function setModel($model);
    function getQuery(): Builder;

    function setQuery($query);

}
