<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;

use App\Http\Requests\UserRequest;
use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Button;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use IceAxe\NativeCloud\Facades\NativeCloudFacade as GridBoard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends IceAxeController
{
    private UserServiceInterface $userService;
    private const ACTION_ROUTE = 'user_store';
    public function __construct(UserServiceInterface $userService)
    {
        GridBoard::setModel('\App\Models\User');

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

    public function CustomButton(): array
    {
        return [
            Button::init(Button::NEW)->setRoute('user_create'),
            Button::init(Button::EDIT)->setRoute('user_edit'),
            Button::init(Button::DELETE)->setRoute('user_delete'),
        ];
    }

    public function filters(): array
    {
        return [
            Field::init('name'),
            Field::init('email'),
            Field::init('mobile'),
            Field::init('created_at'),
        ];
    }

    public function  listOperation(): array
    {
        return [
            Column::init('name'),
            Column::init('email'),
            Column::init('mobile'),
            // Column::init('created_at'),
        ];
    }

    public function setComponentData(mixed $id): array
    {
        $data = $this->userService->getUserPermissions($id);
        return [
            'user.permission' => [1, 23, 3],
        ];
    }
    public function createOperation(): array
    {
        return [
            Field::init('name', 'Name'),
            Field::init('email', 'Email', 'email'),
            Field::init('mobile', 'Mobile', 'number'),
            Field::init('password', 'Password', 'text'),
            Field::init('permission[]', 'Permission', 'component')->setComponent('user.permission')->setData($this->userService->getPermission()),
        ];
    }


    public function create()
    {
        $this->configureForm(self::ACTION_ROUTE);
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
    public function edit(int $id)
    {
        $data = $this->userService->edit($id);
        $componentData = $this->setComponentData($id);
        $this->initEdit($data, self::ACTION_ROUTE, $componentData);
        return view('home.users.edit');
    }
}
