<?php

namespace Cloudy4next\NativeCloud\App\Contracts;

use Cloudy4next\NativeCloud\App\Form\CurdForm;

interface NativeCloudInterface
{

    function configureForm(string $method, string $actionRoute, array $data = null, ?array $componentData = null): CurdForm;
}
