<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use IceAxe\NativeCloud\Facades\NativeCloudFacade as Grid;
use App\Http\Requests\SalesRequest;
use App\Services\SalesService;


class SalesController extends IceAxeController
{
    private const STORE_ROUTE = 'sales.store';
    private const UPDATE_ROUTE = 'sales.update';

    private SalesService $salesService;

    public function __construct(SalesService $salesService)
    {
        Grid::setModel('\App\Models\Sales');
        $this->salesService = $salesService;
    }


    public function index()
    {
        $this->initGrid();

        return view('home.sales.list');
    }

    public function listCustomQuery(): void
    {
        $query = Grid::getQuery();
        $query->where('qty', '>', 2)->orderBy('id', 'desc');
        Grid::setQuery($query);
    }


    public function CustomButton(): array
    {
        return [
            Button::init(Button::NEW)->setRoute('sales.create'),
            Button::init(Button::EDIT)->setRoute('sales.edit'),
            Button::init(Button::DELETE)->setRoute('sales.delete'),
        ];
    }

    public function filters(): array
    {
        return [

            Field::init('product_id'),
            Field::init('retail_id'),
            Field::init('date'),
        ];
    }

    public function listOperation(): array
    {

        return [
            Column::init('product_id', 'Product Name', 'select2',
                [
                    'entity' => 'product',
                    'model' => '\App\Models\Product',
                    'foreign_key' => 'product_id',
                    'attribute' => 'name',
                ]

            ),
            Column::init('retail_id', 'Retail Name', 'select2',
                [
                    'entity' => 'retails',
                    'model' => '\App\Models\Retails',
                    'foreign_key' => 'retail_id',
                    'attribute' => 'retail_name',
                ]

            ),
            Column::init('qty'),
            Column::init('sale_amount'),
            Column::init('date'),
            Column::init('upfront_amount'),
            Column::init('company_id'),
        ];
    }


    public function createOperation(): array
    {
        return [

            Field::init('company_id', 'Company Name', 'select2',
                [
                    'entity' => 'company',
                    'model' => '\App\Models\Company',
                    'foreign_key' => 'company_id',
                    'attribute' => 'name',
                ]

            ),


            Field::init('retail_id', 'Retail Name', 'select2',
                [
                    'entity' => 'retails',
                    'model' => '\App\Models\Retails',
                    'foreign_key' => 'retail_id',
                    'attribute' => 'retail_name',
                ]

            ),
            Field::init('date', 'Date', 'date',),
            Field::init('sales[]', 'Sales', 'component')->setComponent('home.sales.sales-view')
                ->setClassAttribute('col-md-12'),
            Field::init('cash_collected', 'Cash Collected', 'digit',),
            Field::init('credit_collection', 'Credit Collected', 'digit',),

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
