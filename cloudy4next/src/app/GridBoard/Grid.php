<?php

namespace Cloudy4next\NativeCloud\APP\GridBoard;

use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class Grid implements GridInterface
{
    private ?array $columns;
    private array $modelData;
    private ?array $buttons;

    private ?array $filters;

    public function __construct(array $columns ,  $modelData , array $buttons , array $filters )
    {
        $this->columns = $columns;
        $this->modelData = $modelData;
        $this->buttons = $buttons;
        $this->filters = $filters;
    }

    public static function init(array $columns ,  $modelData , array $buttons , array $filters ): self
    {
        return new self($columns, $modelData, $buttons, $filters);
    }

    public function getData()
    {
        return $this->modelData;
    }
    public function getFilter()
    {
        return $this->filters;
    }

    public function getButtons()
    {
        return $this->buttons;
    }

    public function getColumns()
    {
        return $this->columns;
    }
}
