<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Http\Requests\SalesRequest;
use App\Services\SalesService;


class SalesController extends IceAxeController
{
    private const STORE_ROUTE = 'sales.store';
    private const UPDATE_ROUTE = 'sales.update';

    private SalesService $salesService;

    public function __construct(SalesService $salesService)
    {
        $this->salesService = $salesService;
    }


    public function setup(): Builder
    {
        return $this->salesService->getData();
    }

    public function index()
    {
        $this->initGrid();
        return view('home.sales.list');
    }

    public function CustomButton(): array
    {
        return [
            Button::init(Button::NEW)->setRoute('sales.create'),
//            Button::init(Button::EDIT)->setRoute('sales.edit'),
//            Button::init(Button::DELETE)->setRoute('sales.delete'),
        ];
    }

    public function filters(): array
    {
        return [

            Field::init('product_id'),
            Field::init('retail_id'),
            Field::init('date'),
            Field::init('created_at'),
        ];
    }

    public function listOperation(): array
    {
        return [

            Column::init('product_id'),
            Column::init('retail_id'),
            Column::init('qty'),
            Column::init('sale_amount'),
            Column::init('date'),
            Column::init('upfront_amount'),
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

            Field::init('product_id'),
            Field::init('retail_id'),
            Field::init('qty'),
            Field::init('date'),
        ];
    }

    public function create()
    {
        $this->configureForm(self::STORE_ROUTE);
        return view('home.sales.create');
    }

    public function store(SalesRequest $request)
    {
        $this->salesService->store($request);
        return redirect('sales')->with('success', 'Sales Created Successfully');
    }

    public function update(SalesRequest $request)
    {
        $this->salesService->update($request);
        return redirect('sales')->with('success', 'Sales Updated Successfully');
    }

    public function delete($id)
    {
        $this->salesService->delete($id);
        return redirect('sales')->with('success', 'Sales Deleted Successfully');
    }

    public function edit(int $id)
    {
        $data = $this->salesService->edit($id);
        $this->initEdit($data, self::UPDATE_ROUTE);
        return view('home.sales.edit');
    }
}
