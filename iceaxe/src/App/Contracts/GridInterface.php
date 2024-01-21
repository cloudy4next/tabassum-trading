<?php

namespace IceAxe\NativeCloud\App\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface GridInterface
{
    // function createGrid($columns, $data, $filters, $buttons);
    function getData();

    static function init(array $columns, LengthAwarePaginator $modelData, array $buttons, array $filters): self;

}
