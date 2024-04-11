<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\ProductionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    public function login_form()
    {
        if (Auth::guard('employee')->check()) {
            return redirect()->route('employee.dashboard');
        }
        return view('login');
    }

    //todo: employee login functionality
    public function login_functionality(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {
            //return redirect()->route('dashboard');
            $employee = Auth::guard('employee')->user();

            // Store user information in the session
            session(['employee' => $employee]);

            return redirect()->intended('/employee/dashboard');
        } else {
            Session::flash('error-message', 'Invalid Email or Password');
            return back();
        }
    }

    public function dashboard()
    {
        return view('employee.dashboard');
    }

    //todo: employee logout functionality
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('login.form');
    }
}
