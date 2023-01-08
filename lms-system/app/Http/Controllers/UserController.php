<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function usersWithMostRents()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $users = User::withCount('rents')->orderBy('rents_count','DESC')->get();
        return view('users.usersWithMostRents',compact('users'));
    }
}
