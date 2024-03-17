<?php

namespace App\Utils;

use App\Models\Product;
use App\Models\Retails;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Util
{


    public static function calculateUpfrontFromProducts($products): float
    {
        $upfront = 0;
        foreach ($products as $product) {
            $upfront += $product->upfront;
        }
        return $upfront;
    }

    public static function removeZeroValuesInArray($array): array
    {
        return array_filter($array, fn($value) => $value !== "0");
    }

    public static function adjustRetailerCreditDebitBalance(int $customerID, int $amount, string $adjustmentType): void
    {
        $customer = Retails::find($customerID);

        if (!$customer) {
            return;
        }

        $currentBalance = $customer->amount;
        $currentType = $customer->type;

        if ($adjustmentType === $currentType) {
            $newBalance = $currentBalance + $amount;
        } else {
            $newBalance = $currentBalance - $amount;
            if ($newBalance < 0) {
                $newBalance = abs($newBalance);
                $adjustmentType = 'debit';
            } else {
                $adjustmentType = 'credit';
            }
        }

        $customer->amount = $newBalance;
        $customer->type = $adjustmentType;
        $customer->save();
    }

    public static function adjustStock(int $productID, int $qty, string $type): void
    {
        $product_id = $productID;
        $isSold = ($type === 'stock_out') ? true : false;

        $product = Product::findOrFail($product_id);


        //------------------------------------------------------- day stock_in start ----------------------------

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
            ->sum('quantity_in');

        $total_received_quantity = (!$isSold) ? $total_received_quantity + $qty : $total_received_quantity;


        //------------------------------------------------------- day stock_in end ----------------------------


        //------------------------------------------------------- day sales start ----------------------------
        // Calculate the sum of quantities sold within the day
        $total_day_sold_quantity = StockMovement::whereDate('created_at' , now())->sum('quantity_out');
        $total_day_sold_quantity = (!$isSold) ? $total_day_sold_quantity : $total_day_sold_quantity + $qty;

        // Calculate total quantity out for the current month
        $total_sold_quantity = StockMovement::where('product_id', $product_id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('quantity_out');


//------------------------------------------------------- day sales end ----------------------------


        $current_stock = (!$isSold) ? ($product->current_stock + $qty) : ($product->current_stock - $qty);
        $product->current_stock = $current_stock;
        $product->save();


        // Create a new stock movement record
        $movement = new StockMovement();
        $movement->product_id = $product_id;
        $movement->quantity_in = (!$isSold) ? $qty : 0;
        $movement->date = now()->toDateString();
        $movement->type = $type;
        $movement->daily_opening_stock = $previousDayLastStock ? $previousDayLastStock->daily_closing_stock : 0;
        $movement->monthly_opening_stock = $monthly_opening_stock;
        $movement->total_received = $total_received_quantity;
        $movement->quantity_out = $total_day_sold_quantity;
        $movement->total_sold = $total_sold_quantity;
        $movement->daily_closing_stock = $current_stock;
        $movement->stock = $current_stock;
        $movement->save();

    }


}
