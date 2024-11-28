<?php

use App\Http\Controllers\
{
    AuthController,
    ProjectsController,
    ServicesController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

Route::apiResources([
    'services' => ServicesController::class,
    'projects' => ProjectsController::class
]);
