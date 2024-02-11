<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use IceAxe\NativeCloud\Facades\NativeCloudFacade as Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Http\Requests\BankRequest;


class BankController extends IceAxeController
{
    private const STORE_ROUTE = 'bank.store';
    private const UPDATE_ROUTE = 'bank.update';


   public function __construct()
    {
        Grid::setModel('\App\Models\Bank');
    }

    public function setup(): Builder
    {
        return Bank::query();

    }


    public function index()
    {
        $this->initGrid();
        return view('home.bank.list');
    }

    public function CustomButton(): array
    {
        return [
            Button::init(Button::NEW)->setRoute('bank.create'),
            Button::init(Button::EDIT)->setRoute('bank.edit'),
            Button::init(Button::DELETE)->setRoute('bank.delete'),
        ];
    }

    public function filters(): array
    {
        return [

			Field::init('name'),
			Field::init('account_number'),
			Field::init('created_at'),
        ];
    }

    public function  listOperation(): array
    {
        return [

			Column::init('name'),
			Column::init('account_number'),
			Column::init('created_at'),

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
			Field::init('account_number'),
        ];
    }

    public function create()
    {
        $this->configureForm(self::STORE_ROUTE);
        return view('home.bank.create');
    }

    public function store(BankRequest $request)
    {
        return redirect('bank')->with('success', 'Bank Created Successfully');
    }

    public function update(BankRequest $request)
    {
       return redirect('bank')->with('success', 'Bank Updated Successfully');
    }

    public function delete($id)
    {
        return redirect('bank')->with('success', 'Bank Deleted Successfully');
    }

    public function edit(int $id)
    {

        $this->initEdit([], self::UPDATE_ROUTE);
        return view('home.bank.edit');
    }
}
