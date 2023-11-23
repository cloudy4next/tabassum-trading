<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Generic\Field\Button;
use App\Generic\Field\Column;
use App\Generic\Field\Field;
use App\Generic\Form\CurdForm;
use App\Http\Requests\UserRequest;
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

        $filters = [Field::init('name')];
        $columns = [
            Column::init('name'), Column::init('email'),
            Column::init('mobile'), Column::init('created_at')
        ];

        $buttons = [
            Button::init(Button::NEW)->setRoute('user_create'),
            // Button::init(Button::NEW)->setRoute('user_edit'), // need to change
            Button::init(Button::EDIT)->setRoute('user_edit'),
            Button::init(Button::DELETE)->setRoute('user_delete'),
        ];

        return view('home.users.list', compact('columns', 'data', 'filters', 'buttons'));
    }

    public function configureForm(string $method, string $actionRoute, array $data = null, ?array $componentData = null): CurdForm
    {
        $permission = $this->userService->getPermission();
        $column = [
            Field::init('name', 'Name'),
            Field::init('email', 'Email', 'email'),
            Field::init('mobile', 'Mobile', 'number'),
            Field::init('password', 'Password', 'password'),
            Field::init('permission[]', 'Permission', 'component', $permission, 'user.permission')->setComponentData($componentData),
        ];

        return CurdForm::init($column)->setActionRoute($method, $actionRoute)->setData($data);
    }

    public function create(Request $request)
    {

        $form = $this->configureForm('POST', 'user_store');
        return view('home.users.create', compact('form'));
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
        return redirect('users')->with('success', 'User Deleted Successfully');

    }
    public function edit(Request $request)
    {
        $user = $this->userService->edit($request->id);
        $userPermission = [1, 2, 3]; //$this->userService->getPermissions();
        $form = $this->configureForm('POST', 'user_update', $user, $userPermission);
        return view('home.users.edit', compact('form'));
    }
}
