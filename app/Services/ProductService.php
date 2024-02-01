<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{

    public function getData(): Builder
    {
        return Product::query();
    }

    public function store(Request $request)
    {
         // put your method
    }
    public function update(Request $request)
    {
       // put your method
    }
    public function delete($id)
    {
        // put your method
    }
    public function edit($id) : array
    {
        // put your method
    }


}
