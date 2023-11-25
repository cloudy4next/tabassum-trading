<?php

namespace Cloudy4next\NativeCloud\Views\Component;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CurdBoardFilter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('native-cloud::curdboard.filter');
    }
}
