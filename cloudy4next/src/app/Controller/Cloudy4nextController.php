<?php

namespace Cloudy4next\NativeCloud\App\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cloudy4next\NativeCloud\App\Contracts\Cloudy4nextInterface;
use Cloudy4next\NativeCloud\App\Form\CurdForm;
use Cloudy4next\NativeCloud\Facades\NativeCloudFacade;

abstract class Cloudy4nextController extends Controller implements Cloudy4nextInterface
{
    public function initGrid()
    {
        NativeCloudFacade::createGrid($this->listOperation(), $this->setup(),  $this->CustomButton(), $this->filters());
        return $this;
    }

    public function configureForm($type, $actionRoute)
    {
        return NativeCloudFacade::createForm($this->createOperation())->setOperationType($type)->setActionRoute($actionRoute);
    }
}
