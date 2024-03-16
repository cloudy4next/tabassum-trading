<?php

namespace IceAxe\NativeCloud\App\GridBoard;

use IceAxe\NativeCloud\App\Contracts\GridInterface;
use IceAxe\NativeCloud\App\Traits\Relation;
use IceAxe\NativeCloud\App\Traits\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

final class Grid implements GridInterface
{

    use Relation, Query;

    private ?array $columns;
    private Builder $modelData;
    private ?array $buttons;
    private LengthAwarePaginator $data;
    private ?array $filters;

    public Builder $query;

    public Builder|string $model;


    public function __construct(array $columns, array $buttons, array $filters)
    {
        $this->columns = $columns;
        $this->buttons = $buttons;
        $this->filters = $filters;
    }

    public function setModel($model)
    {
        if (!class_exists($model)) {
            throw new \Exception('The model does not exist.', 500);
        }

        $this->model = $model;
        $modelInit = new $model();
        $this->query = $modelInit->select('*');
    }

    public function getQuery(): Builder
    {
        return $this->query;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }


    public function getModel(): string|Builder
    {
        return $this->model;
    }

    public static function init(array $columns, array $buttons, array $filters): self
    {
        return new self($columns, $buttons, $filters);
    }

    public function getData()
    {

        $request = \Request::all();
        $data = self::filterData($request, $this->query);
        $paginator = $this->paginate($data->get());
        $paginator = $paginator->withPath(\Request::url());
        $this->data = $paginator ? $paginator->withQueryString() : $this->paginate(collect([]));
        return $this->data;
    }

    public function getFilter(): ?array
    {
        return $this->filters;
    }

    public function getButtons(): ?array
    {
        return $this->buttons;
    }

    public function getColumns(): ?array
    {

        return $this->columns;
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


    public function paginate($data, $options = []): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?? 1;
        return new LengthAwarePaginator($data->forPage($page, 10), $data->count(), 10, $page, $options);
    }



//    public function filterData($filterRequest, $query)
//    {
//        return collect($filterRequest)
//            ->reject(function ($value, $key) {
//                return $value === null || $key === 'page';
//            })
//            ->reduce(function ($query, $value, $key) {
//                return $query->where($key, $value)-;
//            }, $query);
//    }


}
