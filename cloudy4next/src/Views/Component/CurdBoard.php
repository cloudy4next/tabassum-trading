<?php

declare(strict_types=1);

namespace Cloudy4next\NativeCloud\Views\Component;

use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Illuminate\Contracts\View\View;

class CurdBoard extends AbstractComponent
{
    public GridInterface $grid;



    public function render(): View
    {
        $this->grid = $this->getCrudBoard()->getGrid();
        return view('native-cloud::curdboard.table');
    }
}
