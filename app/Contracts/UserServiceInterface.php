<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    function  getData(Request $request): LengthAwarePaginator;
    function store(array $data);
    function update(Request $request);
    function delete(Request $request);
    function edit(Request $request);
    function getPermission(): Collection;
}
