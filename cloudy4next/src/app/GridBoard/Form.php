<?php

namespace Cloudy4next\NativeCloud\APP\GridBoard;

use Cloudy4next\NativeCloud\App\Contracts\FormInterface;

final class Form implements FormInterface
{
    private ?array $columns;

    private String $operation;

    public const UPDATE = 'update';
    public const CREATE = 'create';
    public function __construct(array $columns)
    {
        $this->columns = $columns;
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
}
