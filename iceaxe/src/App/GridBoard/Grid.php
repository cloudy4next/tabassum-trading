<?php

namespace IceAxe\NativeCloud\App\GridBoard;

use IceAxe\NativeCloud\App\Contracts\GridInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

final class Grid implements GridInterface
{
    private ?array $columns;
    private Builder $modelData;
    private ?array $buttons;

    private LengthAwarePaginator $data;
    private ?array $filters;

    public function __construct(array $columns,  $modelData, array $buttons, array $filters)
    {
        $this->columns = $columns;
        $this->data = $this->setPagination($modelData);
        $this->buttons = $buttons;
        $this->filters = $filters;
    }

    public static function init(array $columns,  $modelData, array $buttons, array $filters): self
    {
        return new self($columns, $modelData, $buttons, $filters);
    }

    public function getData()
    {
        return $this->data;
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

    public function setPagination($modelData)
    {
        $request = \Request::all();
        return $this->filterData($request, $modelData)->paginate(10);
    }

    public function filterData($filtersData, $query)
    {
        foreach ($filtersData as $key => $value) {
            if ($value != null && $key != "page") {
                $query->where($key, $value);
            }
        }
        return $query;
    }
}
