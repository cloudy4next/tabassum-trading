<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $openingStock = 0;

        $latestStockMovements = StockMovement::select('product_id', DB::raw('MAX(created_at) as max_created_at'))
            ->groupBy('product_id');

        $stockMovements = StockMovement::joinSub($latestStockMovements, 'latest_stock_movements', function ($join) {
            $join->on('stock_movement.product_id', '=', 'latest_stock_movements.product_id')
                ->on('stock_movement.created_at', '=', 'latest_stock_movements.max_created_at');
        })->with('product')->get();


        return view('home.stock.list', compact('openingStock', 'stockMovements'));
    }



}
