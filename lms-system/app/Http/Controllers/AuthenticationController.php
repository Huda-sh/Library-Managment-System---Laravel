<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function registration()
    {
        return view('auth.registration');
    }

    function validate_registration(Request $request)
    {
        $request->validate([
            'first_name'  =>   'required',
            'last_name'   =>   'required',
            'phone_number'=>   'required',
            'address'     =>   'required',
            'email'       =>   'required|email|unique:users',
            'password'    =>   'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'first_name'  =>   $data['first_name'],
            'last_name'   =>   $data['last_name'],
            'phone_number'=>   $data['phone_number'],
            'address'     =>   $data['address'],
            'email'       =>   $data['email'],
            'password'    =>   Hash::make($data['password'])
        ]);

        return redirect()->route('auth.login')->with('success', 'Registration Completed, now you can login');
    }

    function validate_login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return redirect()->route('auth.login')->with('success', 'Login details are not valid');
    }

    function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->role=='admin') {
                return redirect()->route('admindashboard');
            }
            return redirect()->route('notifications.index');
        }
        return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
    }
    function admindashboard()
    {
        if (Auth::check()) {
            return redirect()->route('categories.index');
        }
        return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect()->route('auth.login');
    }
}
