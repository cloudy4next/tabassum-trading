<?php

namespace Cloudy4next\NativeCloud\App\Services;

use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Cloudy4next\NativeCloud\APP\GridBoard\Grid;
use Illuminate\Pagination\LengthAwarePaginator;

final class NativeCloudService implements NativeCloudInterface
{
    private GridInterface $grid;


    public function createGrid($columns, $data, $filters, $buttons): GridInterface
    {
        $this->grid = Grid::init($columns, $data, $filters, $buttons);
        return $this->grid;
    }

    public function getGrid(): GridInterface
    {
        return  $this->grid;
    }
}
