<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;

use App\Http\Requests\UserRequest;
use Cloudy4next\NativeCloud\App\Controller\Cloudy4nextController;
use Cloudy4next\NativeCloud\App\Field\Button;
use Cloudy4next\NativeCloud\App\Field\Column;
use Cloudy4next\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Cloudy4nextController
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function setup(): Builder
    {
        return $this->userService->getData();
    }

    public function index()
    {
        $this->initGrid();

        return view('home.users.list');
    }

    public function CustomButton()
    {
        return [
            Button::init(Button::NEW)->setRoute('user_create'),
            Button::init(Button::EDIT)->setRoute('user_edit'),
            Button::init(Button::DELETE)->setRoute('user_delete'),
        ];
    }

    public function filters()
    {
        return [
            Field::init('name'),
            Field::init('email'),
            Field::init('mobile'),
            Field::init('created_at'),
        ];
    }

    public function  listOperation()
    {
        return [
            Column::init('name'),
            Column::init('email'),
            Column::init('mobile'),
            Column::init('created_at'),
        ];
    }

    public function createOperation()
    {
        return [
            Field::init('name', 'Name'),
            Field::init('email', 'Email', 'email'),
            Field::init('mobile', 'Mobile', 'number'),
            Field::init('password', 'Password', 'password'),
            // Field::init('permission[]', 'Permission', 'component', $permission, 'user.permission')->setComponentData($componentData);
        ];
    }


    public function create()
    {
        $this->configureForm('create', 'user_store');
        return view('home.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->userService->store($request->all());
        return redirect('users')->with('success', 'User Created Successfully');
    }

    public function update(Request $request)
    {
        dd($request->all());
        $this->userService->update($request->all());
    }

    public function destroy($id)
    {
        $this->userService->delete($id);
        return redirect('users')->with('success', 'User Deleted Successfully');
    }
    public function edit(Request $request)
    {
        $user = $this->userService->edit($request->id);
        $userPermission = [1, 2, 3];
        $form = $this->configureForm('POST', 'user_update', $user, $userPermission);
        return view('home.users.edit', compact('form'));
    }
}
