<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\UserServiceInterface;
use App\Models\User;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $columns = ['name', 'email'];
        $items = User::paginate(5);
        $actionRoute = ['view' => 'user_edit', 'edit' => 'user_edit', 'delete' => 'user_delete'];
        return view('home.users.list', compact('columns', 'items', 'actionRoute'));
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
