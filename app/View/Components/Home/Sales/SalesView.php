<?php

namespace App\View\Components\Home\Sales;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SalesView extends Component
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
    public function render(): View|Closure|string
    {
        $products = Product::where('is_active',1)->get();
        return view('components.home.sales.sales-view', compact('products'));
    }
}
