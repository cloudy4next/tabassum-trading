<?php

namespace App\Services;

use App\Contracts\PermissionServiceInterface;
use Illuminate\Http\Request;
use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionService implements PermissionServiceInterface
{

    public function getData(): Builder
    {
        $query = Permission::query();
        return $query;
    }

    public function getPermission(): Collection
    {
        return Permission::all();
    }
    public function store(array $data)
    {
        // dd($data);
        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = bcrypt($data["password"]);
        $user->save();

        // $user->givePermissionTo($data['permission']);
    }
    public function update(Request $request)
    {
        dd($request);
    }
    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->revokePermissionTo($user->getAllPermissions());
        }
        $user->delete();
    }
    public function edit($id)
    {
        return User::find($id)->toArray();
    }

    public function getUserPermissions($id)
    {
        $user = User::find($id);
        return $user->getAllPermissions();
    }
}

