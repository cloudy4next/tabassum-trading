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

        return  NativeCloudFacade::createGrid($this->listOperation(), [],  $this->CustomButton(), $this->filters());
    }

    public function configureForm($type)
    {
        return NativeCloudFacade::createForm($this->createOperation())->setOperationType($type);
    }
}
