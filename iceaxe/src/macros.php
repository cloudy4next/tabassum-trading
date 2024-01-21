<?php

use Illuminate\Support\Facades\Route;


if (!Route::hasMacro('iceaxe')) {
    Route::macro('iceaxe', function ($name, $controller) {
        Route::resource($name, $controller)->except(['destroy','edit','update']);
        Route::get("/$name/delete/{id}", [$controller, 'delete'])->name("$name.delete");
        Route::get("/$name/edit/{id}", [$controller, 'edit'])->name("$name.edit");
        Route::post("/$name/update/", [$controller, 'update'])->name("$name.update");

    });
}
