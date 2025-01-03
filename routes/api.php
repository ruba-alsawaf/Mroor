<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeRequestController;
use App\Http\Controllers\EmployeeController;

Route::post('employee/register', [EmployeeRequestController::class, 'register']);
Route::post('employee/login', [EmployeeController::class, 'login']);
