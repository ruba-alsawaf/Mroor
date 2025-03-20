<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\EmployeeController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/employee/register', [EmployeeController::class, 'register']);
Route::get('/approve-request/{id}', [EmployeeController::class, 'approveRequest']);
Route::post('/employee/login', [EmployeeController::class, 'login']);
// Route::post('/employee/{employee_id}/add_license', [EmployeeController::class, 'add_license']);


