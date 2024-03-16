<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SalesService
{


    public function store(Request $request)
    {
        dd($request->all());
        $product = Product::find($request->product_id);
        $dp = $product->dp;
        $rp = $product->rp;
        $upfront = $rp - $dp;
        $totalSaleAmount = ($request->qty * $rp) + $upfront;

        $sales = new Sales();
        $sales->product_id = $request->product_id;
        $sales->retail_id = $request->retail_id;
        $sales->company_id = $request->company_id;
        $sales->date = $request->date;
        $sales->qty = $request->qty;
        $sales->upfront_amount = $upfront;
        $sales->sale_amount = $totalSaleAmount;

        $sales->save();
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

    public function calculateRevenue()
    {
        $sales = Sales::all();
        $totalRevenue = 0;

        foreach ($sales as $sale) {
            $totalRevenue += $sale->getTotalSaleAmount();
        }

        return $totalRevenue;
    }

    public function adjustStockAfterSale(Sale $sale)
    {
        // Retrieve the product and sold quantity from the sale
        $product = $sale->product;
        $soldQuantity = $sale->quantity_sold;

        // Calculate the new stock
        $currentStock = $product->current_stock - $soldQuantity;

        // Create a new stock movement record to adjust the stock
        $stockMovement = new StockMovement();
        $stockMovement->product_id = $product->id;
        $stockMovement->date = Carbon::now(); // Set the date of the adjustment
        $stockMovement->quantity_out = $soldQuantity;
        $stockMovement->closing_stock = $currentStock;

        // Save the stock movement
        $stockMovement->save();

        // Update the product's current stock
        $product->current_stock = $currentStock;
        $product->save();

        return redirect()->route('stock.index')->with('success', 'Stock adjusted after the sale.');
    }



}
