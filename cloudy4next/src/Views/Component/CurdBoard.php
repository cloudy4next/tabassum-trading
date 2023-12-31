<?php

declare(strict_types=1);

namespace Cloudy4next\NativeCloud\Views\Component;

use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CurdBoard extends AbstractComponent
{
    public GridInterface $grid;



    public function render(): View
    {

        $this->grid = $this->getCrudBoard()->getGrid();
        // dd($this->grid);
        return view('native-cloud::curdboard.table');
    }
}
