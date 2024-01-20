<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Cloudy4next\NativeCloud\App\Controller\Cloudy4nextController;
use Cloudy4next\NativeCloud\App\Field\Button;
use Cloudy4next\NativeCloud\App\Field\Column;
use Cloudy4next\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BankController extends Cloudy4nextController
{
    private const ACTION_ROUTE = 'bank.store';

    public function setup(): Builder
    {
        return Bank::query(); // put your action here
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

			Field::init('id'),
			Field::init('name'),
			Field::init('account_number'),
        ];
    }

    public function  listOperation(): array
    {
        return [

			Column::init('id'),
			Column::init('name'),
			Column::init('account_number'),
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
			Field::init('account_number'),
        ];
    }

    public function create()
    {
        $this->configureForm(self::ACTION_ROUTE);
        return view('home.bank.create');
    }

    public function store(Request $request)
    {
        // put your action here
        return redirect('bank')->with('success', 'bank Created Successfully');
    }

    public function update(Request $request)
    {
       // put your action here
       return redirect('bank')->with('success', 'bank Updated Successfully');
    }

    public function delete($id)
    {
        // put your action here
        return redirect('bank')->with('success', 'bank Deleted Successfully');
    }

    public function edit(int $id)
    {

        // put your action here
        $this->initEdit([], self::ACTION_ROUTE); // put you data here
        return view('home.bank.edit');
    }
}
