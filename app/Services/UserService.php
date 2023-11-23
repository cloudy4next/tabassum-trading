<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserService implements UserServiceInterface
{

    public function getData(Request $request): LengthAwarePaginator
    {
        $query = User::query();
        $filtersData =  $request->all();
        foreach ($filtersData as $key => $value) {
            if ($value != null && $key != "page") {
                $query->where($key, $value);
            }
        }
        return $query->paginate(10);
    }

    public function getPermission(): Collection
    {
        return Permission::all();
    }
    public function store(array $data)
    {
        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = bcrypt($data["password"]);
        $user->save();

        $user->givePermissionTo($data['permission']);
    }
    public function update(Request $request)
    {
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

    public function getPermissions(): array
    {
        return Auth::user()->permissions;
    }
}
