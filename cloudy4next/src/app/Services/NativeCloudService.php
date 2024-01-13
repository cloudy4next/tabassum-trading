<?php

namespace Cloudy4next\NativeCloud\App\Services;

use Cloudy4next\NativeCloud\App\Contracts\FormInterface;
use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Cloudy4next\NativeCloud\APP\GridBoard\Form;
use Cloudy4next\NativeCloud\APP\GridBoard\Grid;
use Illuminate\Database\Eloquent\Builder;

final class NativeCloudService implements NativeCloudInterface
{
    private GridInterface $grid;
    private FormInterface $form;

    private Builder $model;

    public function createGrid($columns, $model, $buttons, $filters): GridInterface
    {

        $this->grid = Grid::init($columns, $model, $buttons, $filters);

        return $this->grid;
    }

    public function getGrid(): GridInterface
    {
        return  $this->grid;
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

    public function setSetup(Builder $model) : Builder
    {
        $this->model = $model;
        return $this;
    }
    public function getSetup()
    {
        return $this->model;
    }
}
