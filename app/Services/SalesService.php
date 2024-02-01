<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SalesService
{

    public function getData(): Builder
    {
       return Sales::query();
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

    public function calculateRevenue()
    {
        $sales = Sales::all();
        $totalRevenue = 0;

        foreach ($sales as $sale) {
            $totalRevenue += $sale->getTotalSaleAmount();
        }

        return $totalRevenue;
    }


}
