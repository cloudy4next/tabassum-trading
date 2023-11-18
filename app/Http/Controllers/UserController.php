<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $data = $this->userService->getData($request);

        /**
         * Configuration for list view
         */
        $filters = [['name' => 'name', 'label' => 'Name', 'type' => 'text', 'placeholder' => 'Name...'],];
        $columns = ['name', 'email', 'mobile', 'created_at'];
        $button = ['new' => 'user_create'];
        $actionRoute = ['view' => 'user_edit', 'edit' => 'user_edit', 'delete' => 'user_delete'];


        return view('home.users.list', compact('columns', 'data', 'actionRoute', 'filters', 'button'));
    }

    public function create(Request $request)
    {
        $permission = $this->userService->getPermission();
        // ['name' => 'category', 'label' => 'Category', 'type' => 'select', 'options' => [['value' => 'category1', 'label' => 'Category 1'], ['value' => 'category2', 'label' => 'Category 2']]],
        $column = [
            ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'placeholder' => 'Name...'],
            ['name' => 'mobile', 'label' => 'Mobile', 'type' => 'number', 'placeholder' => 'Mobile...'],
            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'placeholder' => 'Email...'],
            ['name' => 'password', 'label' => 'Passowrd', 'type' => 'password', 'placeholder' => 'Password...'],
            ['name' => 'permission', 'label' => 'Permission', 'type' => 'component', 'placeholder' => 'Component...', 'value' => $permission, 'component' => 'user.permission']
        ];
        $route = 'user_store';
        return view('home.users.create', compact('column', 'route'));
    }

    public function store(UserRequest $request)
    {
        $this->userService->store($request->all());
        return redirect('users')->with('success', 'User Created Successfully');
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
