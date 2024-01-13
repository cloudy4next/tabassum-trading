<?php

namespace Cloudy4next\NativeCloud\APP\GridBoard;

use Cloudy4next\NativeCloud\App\Contracts\FormInterface;

final class Form implements FormInterface
{
    private ?array $columns;

    private String $operation;

    private String $actionMethod;

    private String $actionRoute;

    public const UPDATE = 'update';
    public const CREATE = 'create';

    public const POST = 'POST';
    public function __construct(array $columns)
    {
        $this->columns = $columns;
        $this->actionMethod = $this->getActionMethod();
    }

    public static function init(array $columns): self
    {
        return new self($columns);
    }

    public function getColums()
    {
        return $this->columns;
    }

    public function setOperationType(String $operation)
    {
        $this->operation = $operation;
        return $this;
    }

    public function getOperationType()
    {
        return  $this->operation;
    }


    public function getActionMethod()
    {
        return Form::POST;
    }

    public function setActionRoute(String $actionRoute)
    {
        $this->actionRoute = $actionRoute;
        return $this;
    }

    public function getActionRoute()
    {
        return  $this->actionRoute;
    }
}
