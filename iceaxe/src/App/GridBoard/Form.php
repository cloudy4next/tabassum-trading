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

    public function getColums(): ?array
    {
        return $this->columns;
    }

    public function setOperationType(String $operation): static
    {
        $this->operation = $operation;
        return $this;
    }

    public function getOperationType(): string
    {
        return  $this->operation;
    }


    public function getActionMethod(): string
    {
        return self::POST;
    }

    public function setActionRoute(String $actionRoute): static
    {
        $this->actionRoute = $actionRoute;
        return $this;
    }

    public function getActionRoute(): string
    {
        return  $this->actionRoute;
    }

    public function setData($data): Form
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

    public function getComponentData(): array|Collection|null
    {
        return $this->itemComponentData;
    }
}
