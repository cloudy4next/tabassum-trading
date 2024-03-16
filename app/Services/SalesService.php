<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RetailCreditCollectionHistory;
use App\Models\RetailCreditHistory;
use App\Models\Retails;
use App\Models\RetailSalesHistory;
use App\Utils\util;
use Illuminate\Http\Request;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class SalesService
{

    public function store(Request $request)
    {
//        dd($request->all());
        $soldItemArray = Util::removeZeroValuesInArray($request->quantities);
        $totalUpfront = $this->calculateRevenue(array_keys($soldItemArray));
        $removedZeroValues = Util::removeZeroValuesInArray($request->quantities);

        $sales = new Sales();
        $sales->product_id = json_encode(array_keys($soldItemArray));
        $sales->retail_id = $request->retail_id;
        $sales->company_id = $request->company_id;
        $sales->date = $request->date;
        $sales->qty = json_encode($removedZeroValues);
        $sales->upfront_amount = $totalUpfront;
        $sales->sale_amount = 0;

        $sales->save();
    }


    public function calculateRevenue(array $productIDs): float
    {
        $products = Product::whereIn('id', $productIDs)->get();

        return Util::calculateUpfrontFromProducts($products);
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

    public function adjustRetailerCreditDebitBalance(int $customerID, int $amount, string $type): void
    {
        $customer = Retails::find($customerID);
        $customer->amount -= $amount;
        $customer->type = $type;

        $customer->save();
    }

    public function adjustSalesOfRetailer(int $customerID, int $amount, array $sales_ids, string $saleDate): void
    {
        $salesHistory = new RetailSalesHistory();
        $salesHistory->retail_id = $customerID;
        $salesHistory->sales_id = $sales_ids;
        $salesHistory->sales_date = $saleDate;
        $salesHistory->amount = $amount;

        $salesHistory->save();
    }


    // To-do
    public function updateRetailCredit(float $SaleAmount, float $cashCollected, array $retailID, int $salesID, string $saleDate): void
    {
        $retailCreditHistory = new RetailCreditHistory();
        $retailCreditHistory->retail_id = $retailID;
        $retailCreditHistory->credit_amount = $SaleAmount - $cashCollected;
        $retailCreditHistory->sales_id = $salesIDs;
        $retailCreditHistory->date = $saleDate;

        $retailCreditHistory->save();
    }


    public function retailCreditCollectionHistory(int $collectedAmount, $previousCredit, int $retailID,): void
    {
        $retailCreditCollectionHistory = new RetailCreditCollectionHistory();
        $retailCreditCollectionHistory->retail_id = $retailID;
        $retailCreditCollectionHistory->prev_credit_amount = $totalCreditAmount;
        $retailCreditCollectionHistory->collection_amount = $collectedAmount;
        $retailCreditCollectionHistory->save();
    }

    public function update(Request $request)
    {
    }

    public function delete($id)
    {
    }

    public function edit($id): array
    {
    }


}
