<?php

declare(strict_types=1);

namespace Cloudy4next\NativeCloud\Views\Component;

use Cloudy4next\NativeCloud\App\Contracts\GridInterface;
use Cloudy4next\NativeCloud\App\Contracts\NativeCloudInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


abstract class AbstractComponent extends Component
{
    public function __construct(private NativeCloudInterface $crudBoard)
    {
    }

    public function getCrudBoard(): NativeCloudInterface
    {
        return $this->crudBoard;
    }
}
