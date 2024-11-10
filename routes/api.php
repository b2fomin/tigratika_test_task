<?php

use App\Http\Controllers\Group as Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function () {
    Route::get('/group', Group\IndexController::class);
    Route::get('/group/{id}/subgroups', Group\SubGroupsController::class);
    Route::delete('/group/{id}', Group\DeleteController::class);
});
