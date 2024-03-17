<?php

namespace App\Services;

use App\Models\StockMovement;
use App\Utils\Util;
use IceAxe\NativeCloud\Exceptions\RedirectWithError;
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
        if ($request->rp < $request->dp) {
            throw new RedirectWithError('Retail price cannot be less than dealer price');
        }
        $product = new Product();
        $product->name = $request->name;
        $product->rp = $request->rp;
        $product->dp = $request->dp;
        $product->barcode = 123456789;
        $product->current_stock = 0;
        $product->upfront = ($request->rp - $request->dp);
        $product->company_id = $request->company_id;
        $product->save();
    }

    public function update(Request $request)
    {
        if ($request->rp < $request->dp) {
            throw new RedirectWithError('Retail price cannot be less than dealer price');
        }
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->rp = $request->rp;
        $product->dp = $request->dp;
        $product->upfront = ($request->rp - $request->dp);
        $product->company_id = $request->company_id;
        $product->save();
    }

    public function delete($id): void
    {
        Product::where('id', $id)->delete();
    }

    public function edit($id): array
    {
        return Product::where('id', $id)->first()->toArray();
    }


    public function stockUpdate(Request $request): void
    {
        Util::adjustStock($request->id, $request->quantity_in, 'stock_in');
    }


}
