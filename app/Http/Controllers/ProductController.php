<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use IceAxe\NativeCloud\Facades\NativeCloudFacade as Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ProductController extends IceAxeController
{
    private const STORE_ROUTE = 'product.store';
    private const UPDATE_ROUTE = 'product.update';

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        Grid::setModel('\App\Models\Product');

        $this->productService = $productService;
    }


    public function index()
    {
        $this->initGrid();
        return view('home.product.list');
    }

    public function CustomButton(): array
    {
        return [
            Button::init(Button::NEW)->setRoute('product.create'),
            Button::init(Button::EDIT)->setRoute('product.edit'),
            Button::init(Button::INLINE, 'stock')->setRoute('product.stock'),
            Button::init(Button::DELETE)->setRoute('product.delete'),
        ];
    }

    public function filters(): array
    {
        return [

            Field::init('name'),
            Field::init('company_id'),
        ];
    }

    public function listOperation(): array
    {
        return [

            Column::init('name'),
            Column::init('barcode'),
            Column::init('dp'),
            Column::init('rp'),
            Column::init('upfront'),
            Column::init('current_stock'),
            Column::init('company_id'),

        ];
    }

    public function setComponentData(mixed $id): array
    {
        return [];
    }

    public function createOperation(): array
    {
        return [

            Field::init('name'),
            Field::init('barcode'),
            Field::init('dp'),
            Field::init('rp'),
            Field::init('upfront'),
            Field::init('current_stock'),
            Field::init('company_id'),
        ];
    }

    public function create()
    {
        $this->configureForm(self::STORE_ROUTE);
        return view('home.product.create');
    }

    public function store(ProductRequest $request)
    {
        $this->productService->store($request);
        return redirect('product')->with('success', 'Product Created Successfully');
    }

    public function update(ProductRequest $request)
    {
        $this->productService->update($request);
        return redirect('product')->with('success', 'Product Updated Successfully');
    }

    public function delete($id)
    {
        $this->productService->delete($id);
        return redirect('product')->with('success', 'Product Deleted Successfully');
    }

    public function edit(int $id)
    {
        $data = $this->productService->edit($id);
        $this->initEdit($data, self::UPDATE_ROUTE);
        return view('home.product.edit');
    }

    public function stock($id)
    {
        $product = $this->productService->edit($id);
        return view('home.product.stock', compact('product'));
    }

    public function stockUpdate(Request $request)
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
        return redirect()->route('stock.index')->with('success', 'Stock movement recorded successfully.');

    }
}
