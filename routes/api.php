<?php

use App\Http\Controllers\Group\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1'], function () {
    Route::get('/group', IndexController::class);
})->middleware('auth:sanctum');
