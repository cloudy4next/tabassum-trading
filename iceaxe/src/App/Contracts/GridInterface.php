<?php

namespace IceAxe\NativeCloud\App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

interface GridInterface
{
    function getData();
    function setModel(string $model);
    static function init(array $columns, array $buttons, array $filters): self;
    function getQuery();

    function setQuery($query);
}

