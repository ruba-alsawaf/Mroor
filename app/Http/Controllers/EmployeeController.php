<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRequest;
use Illuminate\Http\Request;
use App\Mail\EmployeeRegistrationRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Mail\EmployeeApprovedMail;
use App\Mail\ApprovalMail;

class EmployeeController extends Controller
{
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|unique:employee_requests,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $employeeRequest = EmployeeRequest::create([
    //         'email' => $request->email,
    //         'password' => bcrypt($request->password),
    //         'status' => 'pending',
    //     ]);

    //     Mail::to('rubaalsawaf2003@gmail.com')->send(new EmployeeRegistrationRequest($employeeRequest));

    //     return response()->json(['message' => 'Registration request has been sent successfully, awaiting approval.'], 200);
    // }
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|string|max:255|unique:employee_requests',
            'password' => 'required|string|min:8',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

            EmployeeRequest::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json(['message' => 'Your request has been submitted successfully. Wait for acceptance.']);
        }
        public function approveRequest($id)
{
    $employeeRequest = EmployeeRequest::find($id);

    if (!$employeeRequest) {
        return response()->json(['message' => 'Request not found'], 404);
    }

    $employee = Employee::create([
        'email' => $employeeRequest->email,
        'password' => $employeeRequest->password,
    ]);

    $employeeRequest->delete();

    try {
        Mail::to($employee->email)->send(new EmployeeApprovedMail($employee));
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Employee approved but email not sent',
            'error' => $e->getMessage()
        ], 500);
    }

    return response()->json([
        'message' => 'Employee approved and email sent successfully',
        'email' => $employee->email
    ]);
}


}
