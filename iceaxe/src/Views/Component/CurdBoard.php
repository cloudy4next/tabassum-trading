<?php

declare(strict_types=1);

namespace IceAxe\NativeCloud\Views\Component;

use IceAxe\NativeCloud\App\Contracts\GridInterface;
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
