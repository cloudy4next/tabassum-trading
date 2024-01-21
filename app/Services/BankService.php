<?php

namespace App\Services;

use App\Models\Bank;
use Illuminate\Http\Request;
class BankService
{

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'account_number' => 'required|integer',
        ]);

        $bank = new Bank();
        $bank->name = $request->name;
        $bank->account_number = $request->account_number;
        $bank->save();
    }

    public function update(Request $request)
    {

    }
    public function delete($id)
    {
        Bank::destroy($id);
    }
    public function getEditData($id)
    {
        return Bank::where('id',$id)->first();
    }

}
