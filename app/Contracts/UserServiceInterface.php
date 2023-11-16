<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserServiceInterface
{

    function store(Request $request);
    function update(Request $request);
    function delete(Request $request);
    function edit(Request $request);
}
