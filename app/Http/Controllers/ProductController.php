<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends IceAxeController
{
    private const ACTION_ROUTE = 'product.store';

    public function setup(): Builder
    {
        return Builder; // put your action here
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

			Field::init('id'),
			Field::init('name'),
			Field::init('barcode'),
			Field::init('dp'),
			Field::init('rp'),
			Field::init('upfront'),
			Field::init('initial_stock'),
			Field::init('current_stock'),
			Field::init('company_id'),
        ];
    }

    public function  listOperation(): array
    {
        return [

			Column::init('id'),
			Column::init('name'),
			Column::init('barcode'),
			Column::init('dp'),
			Column::init('rp'),
			Column::init('upfront'),
			Column::init('initial_stock'),
			Column::init('current_stock'),
			Column::init('company_id'),
        ];
    }

    public function setComponentData($id): array
    {
        return [];
    }

    public function createOperation(): array
    {
        return [


			Field::init('id'),
			Field::init('name'),
			Field::init('barcode'),
			Field::init('dp'),
			Field::init('rp'),
			Field::init('upfront'),
			Field::init('initial_stock'),
			Field::init('current_stock'),
			Field::init('company_id'),
        ];
    }

    public function create()
    {
        $this->configureForm(self::ACTION_ROUTE);
        return view('home.product.create');
    }

    public function store(Request $request)
    {
        // put your action here
        return redirect('product')->with('success', 'product Created Successfully');
    }

    public function update(Request $request)
    {
       // put your action here
       return redirect('product')->with('success', 'product Updated Successfully');
    }

    public function destroy($id)
    {
        // put your action here
        return redirect('product')->with('success', 'product Deleted Successfully');
    }

    public function edit(int $id)
    {

        // put your action here
        $this->initEdit([], self::ACTION_ROUTE); // put you data here
        return view('home.product.edit');
    }
}
