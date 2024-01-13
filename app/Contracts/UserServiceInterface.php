<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    function getData(): Builder;
    function store(array $data);
    function update(Request $request);
    function delete(int $id);
    function edit(int $id);
    function getPermission(): Collection;

    function getPermissions(): array;
}
