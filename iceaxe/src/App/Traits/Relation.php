<?php

namespace IceAxe\NativeCloud\App\Traits;

trait Relation
{


//    public function dataLoader($fullModelName, $columns)
//    {
//
//        new \App\Models\Sales::all();
//    }
//    public function setPagination($modelData)
//    {
//        $request = \Request::all();
//        $page = $request['page'] ?? 1;
//        $perPage = $request['perPage'] ?? 10;
//        $offset = ($page - 1) * $perPage;
//        $this->filterData($request, $modelData)
//        $data = $modelData->forPage($page, $perPage);
//        $total = $modelData->count();
//        return new \Illuminate\Pagination\LengthAwarePaginator($data, $total, $perPage, $page);
//    }

    public function getRelationalData($model, $attribute)
    {
        $initModel = new $model();
        return $model::select('id', $attribute)->get();
    }

}
