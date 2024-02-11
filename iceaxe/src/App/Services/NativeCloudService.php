<?php

namespace IceAxe\NativeCloud\App\Services;

use IceAxe\NativeCloud\App\Contracts\FormInterface;
use IceAxe\NativeCloud\App\Contracts\GridInterface;
use IceAxe\NativeCloud\App\Contracts\NativeCloudInterface;
use IceAxe\NativeCloud\APP\GridBoard\Form;
use IceAxe\NativeCloud\APP\GridBoard\Grid;
use Illuminate\Database\Eloquent\Builder;

final class NativeCloudService extends AbstractCrudBoard implements NativeCloudInterface
{
    private GridInterface $grid;
    private FormInterface $form;
    private Builder $data;
    private string|\Illuminate\Database\Eloquent\Builder $model;

    public function createGrid($columns, $buttons, $filters): GridInterface
    {

        $this->grid = Grid::init($columns, $buttons, $filters);
        $this->grid->setModel($this->model);
        return $this->grid;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }


    public function getGrid(): GridInterface
    {
        return $this->grid;
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }

    public function createForm($columns): FormInterface
    {
        $this->form = Form::init($columns);
        return $this->form;
    }

    public function setSetup(Builder $data): Builder
    {
        $this->data = $data;

    }

    public function getSetup(): Builder
    {
        return $this->data;
    }

}
