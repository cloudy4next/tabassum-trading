<?php

namespace App\Services;

use App\Models\StockMovement;
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
        // Extract data from request
        $product_id = $request->id;
        $quantity_in = $request->quantity_in;

        // Find the product
        $product = Product::findOrFail($product_id);

        // Retrieve the previous day's last stock movement
        $previousDayLastStock = StockMovement::where('product_id', $product_id)
            ->whereDate('created_at', '<', now()->toDateString())
            ->orderByDesc('created_at')
            ->first();

        // Retrieve the last month's closing stock
        $last_month_closing_stock = StockMovement::where('product_id', $product_id)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->orderByDesc('created_at')
            ->first();

        // Calculate monthly opening stock
        $monthly_opening_stock = $last_month_closing_stock ? $last_month_closing_stock->daily_closing_stock : 0;

        // Calculate total received quantity for the current month
        $total_received_quantity = StockMovement::where('product_id', $product_id)
            ->whereDate('created_at', '>=', Carbon::now()->startOfMonth()) // From the first day of the current month
            ->whereDate('created_at', '<=', now()) // To today
            ->where('quantity_in', '>', 0)
            ->sum('quantity_in');

        $total_received_quantity += $quantity_in;

        // Calculate total quantity out for the current month
        $total_sold_quantity = StockMovement::where('product_id', $product_id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('quantity_out', '<', 0)
            ->sum('quantity_out');

        $product->current_stock += $quantity_in;
        $product->save();


        // Create a new stock movement record
        $movement = new StockMovement();
        $movement->product_id = $product_id;
        $movement->quantity_in = $quantity_in;
        $movement->date = now()->toDateString();
        $movement->type = 'stock_in';
        $movement->daily_opening_stock = $previousDayLastStock ? $previousDayLastStock->daily_closing_stock : 0;
        $movement->monthly_opening_stock = $monthly_opening_stock;
        $movement->total_received = $total_received_quantity;
        $movement->quantity_out = $total_sold_quantity;
        $movement->total_sold = $total_sold_quantity;
        $movement->daily_closing_stock = $product->current_stock;
        $movement->stock = $product->current_stock;
        $movement->save();

    }





}
