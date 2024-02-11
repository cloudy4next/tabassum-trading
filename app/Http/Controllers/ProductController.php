<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;


class ProductController extends IceAxeController
{
    private const STORE_ROUTE = 'product.store';
    private const UPDATE_ROUTE = 'product.update';

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function setup(): Builder
    {
        return Product::query();
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
            Button::init(Button::DELETE)->setRoute('product.delete'),
        ];
    }

    public function filters(): array
    {
        return [

			Field::init('name'),
			Field::init('barcode'),
			Field::init('dp'),
			Field::init('rp'),
			Field::init('upfront'),
			Field::init('initial_stock'),
			Field::init('current_stock'),
			Field::init('company_id'),
			Field::init('created_at'),
			Field::init('updated_at'),
        ];
    }

    public function  listOperation(): array
    {
        return [

			Column::init('name'),
			Column::init('barcode'),
			Column::init('dp'),
			Column::init('rp'),
			Column::init('upfront'),
			Column::init('initial_stock'),
			Column::init('current_stock'),
			Column::init('company_id'),
			Column::init('created_at'),
			Column::init('updated_at'),
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
			Field::init('initial_stock'),
			Field::init('current_stock'),
			Field::init('company_id'),
			Field::init('created_at'),
			Field::init('updated_at'),
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
}
