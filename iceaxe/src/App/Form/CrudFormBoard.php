<?php

namespace IceAxe\NativeCloud\App\Form;

use Illuminate\Database\Eloquent\Model;

class CrudFormBoard
{
    public Model $model;

    public String $route;


    public function __construct($model, $route)
    {
        $this->model = $model;
        $this->route = $route;
    }

    public static function init(Model $model, String $route): self
    {
        return new self($model, $route);
    }

    public function setRoute(String $route)
    {
        $this->route = $route;
    }
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }
    public function getRoute()
    {
        return $this->route;
    }
}
