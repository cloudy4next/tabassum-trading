<?php

namespace IceAxe\NativeCloud\App\Form;


class CurdForm
{
    public ?String $actionMethod;
    public ?string $actionRoute;
    public array $column;
    public ?array $editData;
    public function __construct($column)
    {
        $this->column = $column;
    }

    public static function init(array $column): self
    {
        return new static($column);
    }

    public function setActionRoute(string $method, string $route): self
    {
        $this->actionMethod = $method;
        $this->actionRoute = $route;
        return $this;
    }

    public function setData(?array $data): self
    {
        $this->editData = $data;
        return $this;
    }
}
