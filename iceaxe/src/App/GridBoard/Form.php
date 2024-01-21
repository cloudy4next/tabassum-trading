<?php

namespace IceAxe\NativeCloud\App\GridBoard;

use IceAxe\NativeCloud\App\Contracts\FormInterface;
use Illuminate\Support\Collection;

final class Form implements FormInterface
{
    private ?array $columns;

    private String $operation;

    private String $actionMethod;

    private null|array|Collection $itemComponentData;
    private mixed $data;
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
        return self::POST;
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

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }


    public function setComponentData($data): Form
    {
        $this->itemComponentData = $data;
        return $this;
    }

    public function getComponentData()
    {
        return $this->itemComponentData;
    }
}
