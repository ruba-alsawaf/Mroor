<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->query('email');
        $password = $request->query('password');

        if (!$email || !$password) {
            return response()->json(['error' => 'Missing email or password'], 400);
        }

        if ($email === 'ruba@mroor.com' && $password === '11111111') {
            return response()->json(['message' => 'Login successful'], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

}
