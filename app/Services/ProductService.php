<?php

namespace App\Services;

use App\Models\StockMovement;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class ProductService
{

    public function getData(): Builder
    {
        return Product::query();
    }

    public function store(Request $request)
    {
//        dd($request->all());
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
        return Product::where('id', $id)->first()->toArray();
    }


    public function  stockUpdate(Request $request): void
    {
        Util::adjustStock($request->id, $request->quantity_in, 'stock_in');
    }





}
