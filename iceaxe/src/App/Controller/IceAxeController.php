<?php

namespace IceAxe\NativeCloud\App\Controller;

use App\Http\Controllers\Controller;
use IceAxe\NativeCloud\App\Contracts\IceAxeInterface;
use IceAxe\NativeCloud\Facades\NativeCloudFacade;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
abstract class IceAxeController extends Controller implements IceAxeInterface
{

    /**
     * @return $this
     */
    public function initGrid(): static
    {

        NativeCloudFacade::createGrid($this->listOperation(), $this->setup(), $this->CustomButton(), $this->filters());
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


    /**
     * @param $data edit data as id ;
     * @param $actionRoute update route
     * @param $componentData ComponentData
     * @return $this
     */
    public function initEdit($data, $actionRoute, $componentData = null): static
    {
        NativeCloudFacade::createForm($this->createOperation())->setActionRoute($actionRoute)->setData($data)->setComponentData($componentData);
        return $this;
    }

    abstract public function setup(): Builder;

    abstract public function listOperation(): array;

    abstract public function createOperation(): array;

    abstract public function CustomButton():array;

    abstract public function filters(): array;
    /**
     * @param mixed $id to find corresponding data of item.
     *
     * @return array should like this [componentName => componentData,etc...]
     */
    abstract public function setComponentData($id);


}
