<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [EmployeeRequestController::class, 'index'])->name('dashboard');
Route::get('/employee-requests', [EmployeeRequestController::class, 'index'])->name('employeeRequests.index');
Route::get('accept-request/{id}', [EmployeeRequestController::class, 'acceptRequest'])->name('acceptRequest');
Route::get('reject-request/{id}', [EmployeeRequestController::class, 'rejectRequest'])->name('rejectRequest');

