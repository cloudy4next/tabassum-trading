<?php

namespace App\Http\Controllers;

use IceAxe\NativeCloud\App\Controller\IceAxeController;
use IceAxe\NativeCloud\App\Field\Column;
use IceAxe\NativeCloud\App\Field\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Contracts\PermissionServiceInterface;

/**
 *
 */
class PermissionController extends IceAxeController
{
    private PermissionServiceInterface $permissionService;
    private const ACTION_ROUTE = 'user_store';
    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function setup(): Builder
    {
        return $this->permissionService->getData();
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->initGrid();
        return view('home.permission.list');
    }

    public function CustomButton(): array
    {
        return [

        ];
    }

    public function filters(): array
    {
        return [
            Field::init('name'),

        ];
    }

    public function  listOperation(): array
    {
        return [
            Column::init('name'),

             Column::init('created_at'),
        ];
    }

    public function setComponentData($id): array
    {
        return [
        ];
    }


    function createOperation(): array
    {
        // TODO: Implement createOperation() method.
    }
}
