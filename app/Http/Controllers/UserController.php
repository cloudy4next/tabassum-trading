<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $filtersData =  Request::all();
        $query = User::query();
        $filters = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'placeholder' => 'Name...'],

        ];
        foreach ($filtersData as $key => $value) {
            if ($value != null) {
                $query->where($key, $value);
            }
        }

        $columns = ['name', 'email', 'created_at', 'updated_at'];
        $items = $query->paginate(10);
        $button = ['new' => 'user_create'];
        $actionRoute = ['view' => 'user_edit', 'edit' => 'user_edit', 'delete' => 'user_delete'];
        return view('home.users.list', compact('columns', 'items', 'actionRoute', 'filters', 'button'));
    }

    public function store(Request $request)
    {
        $this->userService->create($request->all());
    }
    public function update(Request $request)
    {
        $this->userService->update($request->all());
    }

    public function destroy($id)
    {
        $this->userService->delete($id);
    }
    public function edit($id)
    {
        $user = $this->userService->edit($id);
    }
}
