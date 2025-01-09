<?php

namespace App\Http\Controllers;

use APP\Models\License;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $employee->createToken('employee_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

    public function add_license(Request $request, $employee_id)
   {

       $validator = Validator::make($request->all(), [
        'id' =>'required|integer|unique:licenses,id',
        'first_name' => 'required|string|max:50',
        'middle_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'national_id' => 'required|string|unique:licenses,national_id',
        'email' => 'required|email|unique:licenses,email',
        'points' => 'required|integer|min:0|max:25',
        'expiration_date' => 'required|date',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $employee = Employee::find($employee_id);

    if (!$employee) {
        return response()->json(['error' => 'Employee not found'], 404);
    }

    $license = $employee->licenses()->create($validator->validated());

    return response()->json([
        'status' => 'success',
        'message' => 'License added successfully',
        'data' => $license
    ], 201);
    }


}
