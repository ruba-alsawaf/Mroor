<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\EmployeeController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/employee/register', [EmployeeRequestController::class, 'register']);
Route::post('/employee/login', [EmployeeController::class, 'login']);
