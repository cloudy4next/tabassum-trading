<?php

namespace Cloudy4next\NativeCloud\App\Controller;

use App\Http\Controllers\Controller;
use Cloudy4next\NativeCloud\App\Contracts\Cloudy4nextInterface;
use Cloudy4next\NativeCloud\Facades\NativeCloudFacade;

abstract class Cloudy4nextController extends Controller implements Cloudy4nextInterface
{
    public function initGrid(): static
    {
        NativeCloudFacade::createGrid($this->listOperation(), $this->setup(),  $this->CustomButton(), $this->filters());
        return $this;
    }

    /**
     * @param mixed $actionRoute etc .. create or update route
     *
     */
    public function configureForm(mixed $actionRoute): static
    {
        NativeCloudFacade::createForm($this->createOperation())->setActionRoute($actionRoute);
        return $this;
    }

    public function initEdit($data, $actionRoute, $componentData = null): static
    {
        NativeCloudFacade::createForm($this->createOperation())->setActionRoute($actionRoute)->setData($data)->setComponentData($componentData);
        return $this;
    }

    /**
     * @param mixed $id to find corresponding data of item.
     *
     * @return array should like this [componentName => componentData,etc...]
     */
}
