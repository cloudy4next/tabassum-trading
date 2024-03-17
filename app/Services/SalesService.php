<?php

namespace App\Services;

use App\Models\Product;
use App\Models\RetailCreditCollectionHistory;
use App\Models\RetailCreditHistory;
use App\Models\Retails;
use App\Models\StockMovement;
use App\Utils\util;
use IceAxe\NativeCloud\Exceptions\RedirectWithError;
use Illuminate\Http\Request;
use App\Models\Sales;
use Carbon\Carbon;

class SalesService
{

    /**
     * @throws RedirectWithError
     */
    public function store(Request $request)
    {
        $soldItemArray = Util::removeZeroValuesInArray($request->quantities);

        if (empty($soldItemArray)) {
            throw new RedirectWithError('No product was sold');
        }

        $totalUpfront = 0;
        $totalSalesAmount = 0;
        $productIDs = array_keys($soldItemArray);
        $soldItem = [];
        foreach ($soldItemArray as $productID => $quantity) {
            $product = $this->getProduct($productID);
            if ($product->current_stock < $quantity) {
                throw new RedirectWithError('The quantity of ' . $product->name . ' sold is more than the available stock');
            }

            $totalUpfront = ($product->upfront * $quantity);
            $totalSalesAmount = ($product->rp * $quantity);


            $sales = new Sales();
            $sales->product_id = $productID;
            $sales->retail_id = $request->retail_id;
            $sales->company_id = $request->company_id;
            $sales->date = $request->date;
            $sales->qty = $quantity;
            $sales->upfront_amount = $totalUpfront;
            $sales->sale_amount = $totalSalesAmount;
            $sales->save();

            $soldItem[] += $sales->id;

            Util::adjustStock($productID, $quantity, 'stock_out');
        }
        $todayCreditAmount = $totalSalesAmount - $request->cash_collected;
        $retail = Retails::find($request->retail_id);

        if ($todayCreditAmount > 0) {
            $this->updateRetailCredit($totalSalesAmount, ($totalSalesAmount - $request->cash_collected), $retail->id, $soldItem, $request->date);
            Util::adjustRetailerCreditDebitBalance($retail->id, $todayCreditAmount, 'credit');

        }

        if ($request->credit_collection > 0) {
            $this->retailCreditCollectionHistory($request->credit_collection, $retail->amount, $retail->id, $request->date);
            Util::adjustRetailerCreditDebitBalance($request->retail_id, $request->credit_collection, 'debit');

        }

        return redirect()->route('stock.index')->with('success', 'Sale Saved and Stock adjusted after the sale.');

    }


    public
    function updateRetailCredit(float $SaleAmount, float $creditAmount, int $retailID, array $salesID, string $saleDate): void
    {
        $retailCreditHistory = new RetailCreditHistory();
        $retailCreditHistory->retail_id = $retailID;
        $retailCreditHistory->credit_amount = $creditAmount;
        $retailCreditHistory->sales_id = json_encode($salesID);
        $retailCreditHistory->date = $saleDate;
        $retailCreditHistory->save();
    }


    public
    function retailCreditCollectionHistory(int $collectedAmount, $previousCredit, int $retailID, string $collectionDate): void
    {
        $retailCreditCollectionHistory = new RetailCreditCollectionHistory();
        $retailCreditCollectionHistory->retail_id = $retailID;
        $retailCreditCollectionHistory->prev_credit_amount = $previousCredit;
        $retailCreditCollectionHistory->collection_amount = $collectedAmount;
        $retailCreditCollectionHistory->collection_date = $collectionDate;
        $retailCreditCollectionHistory->save();
    }

    public function getProduct(int $productID): Product
    {
        return Product::where('id', $productID)->first();
    }

    public function delete($id)
    {
    }


}
