<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StockMovementService
{

    public function getData(): Builder
    {

        $today = now()->toDateString();

        // Retrieve the last recorded closing stock for the previous day
        $lastClosingStock = StockMovement::where('date', '<', $today)
            ->orderBy('date', 'desc')
            ->first();

        // If there's no previous record, use the initial stock
        if (!$lastClosingStock) {
            $initialStock = Product::sum('initial_stock');
            return $initialStock;
        }

        // Calculate the opening stock for today
        $openingStock = $lastClosingStock->closing_stock;

        return $openingStock;

//       return StockMovement::query();
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
