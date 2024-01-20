<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface PermissionServiceInterface
{
    function getData(): Builder;

}
