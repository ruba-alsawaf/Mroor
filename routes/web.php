<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeRequestController;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Mail;

