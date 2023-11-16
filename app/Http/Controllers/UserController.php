<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\UserServiceInterface;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        dd('here');
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
