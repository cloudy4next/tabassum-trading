<?php

namespace Cloudy4next\NativeCloud\App\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cloudy4next\NativeCloud\App\Contracts\Cloudy4nextInterface;
use Cloudy4next\NativeCloud\Facades\NativeCloudFacade;

abstract class Cloudy4nextController extends Controller implements Cloudy4nextInterface
{
    public function initGrid($columns, $data, $buttons, $filters)
    {
        NativeCloudFacade::createGrid($columns, $data, $filters, $buttons);
        return $this;
    }
}
