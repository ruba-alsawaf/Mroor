<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EmployeeRequestController extends Controller
{
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:employee_requests',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        if (strpos($request->email, '@mrror') !== false) {
            EmployeeRequest::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json(['message' => 'Your request has been submitted successfully. Wait for acceptance.']);
        }

        return response()->json(['error' => 'Email must contain @mrror'], 422);
    }

    public function index()
    {
        $requests = EmployeeRequest::all();
        return view('dashboard', compact('requests'));
    }

    public function acceptRequest($id)
    {
        $request = EmployeeRequest::find($id);

        if ($request) {
            Employee::create([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $request->delete();

            return redirect()->route('employeeRequests.index')->with('message', "The employee's request has been accepted.");
        }

        return redirect()->route('employeeRequests.index')->with('error', 'The request is not available');
    }

    public function rejectRequest($id)
    {
        $request = EmployeeRequest::find($id);

        if ($request) {
            $request->delete();

            return redirect()->route('employeeRequests.index')->with('message', "The employee's request was rejected.");
        }

        return redirect()->route('employeeRequests.index')->with('error', 'The request is not available');
    }
}

