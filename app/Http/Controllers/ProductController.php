<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use IceAxe\NativeCloud\Facades\NativeCloudFacade as Grid;
use Illuminate\Http\Request;



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

    public function listCustomQuery(): void
    {
        $query = Grid::getQuery();
//        $query->where('is_active', 1)->orderBy('id', 'desc');
        Grid::setQuery($query);
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
            Field::init('is_active','Is Active','checkbox'),

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

    public function stockUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {

        $this->productService->stockUpdate($request);
        return redirect()->route('stock.index')->with('success', 'Stock movement recorded successfully.');

    }
}
