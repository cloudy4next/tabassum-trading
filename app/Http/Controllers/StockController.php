<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Retrieve the daily opening stock for today
        $openingStock = $this->calculateDailyOpeningStock();
        $stockMovements = StockMovement::orderBy('date', 'desc')->get();
        return view('home.stock.list', compact('openingStock', 'stockMovements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Handle stock movement creation here
        // Update the current stock and record the movement
        // You can use Eloquent to create a new StockMovement record
    }


    private function calculateDailyOpeningStock()
    {
        $today = now()->toDateString();

        $lastClosingStock = StockMovement::where('date', '<', $today)
            ->orderBy('date', 'desc')
            ->first();

        if (!$lastClosingStock) {
            return Product::sum('initial_stock');
        }

        return $lastClosingStock->closing_stock;
    }

}
