<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $rents = Rent::all();
        $users = User::all();
        return view('rents.index', compact('rents', 'users'));
    }

    public function rentforUser()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $rents = Auth::user()->rents;
        return view('rents.rentforuser', compact('rents'));
    }
    public function rentOfUser($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        if ($id == 0) {
            return redirect()->route('rents.index');
        }
        $rents = User::findOrFail($id)->rents;
        $users = User::all();
        return view('rents.index', compact('rents', 'users'));
    }

    public function rentInRange(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $request->validate([
            's_date'  =>   'required',
            'e_date'  =>   'required',
        ]);
        $rents = Rent::query()
        ->whereDate('start_date', '>=', $request->s_date)
        ->whereDate('start_date', '<=', $request->e_date)
        ->get();
        $users = User::all();
        return view('rents.index', compact('rents', 'users'));

    }

    public function rentInRangeForUser(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $request->validate([
            's_date'  =>   'required',
            'e_date'  =>   'required',
        ]);
        $rents = Rent::query()
        ->whereDate('start_date', '>=', $request->s_date)
        ->whereDate('start_date', '<=', $request->e_date)
        ->where('user_id',Auth::id())
        ->get();
        return view('rents.rentforuser', compact('rents'));

    }

    public function create()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $users = User::all();
        $books = Book::all();
        return view('rents.create', compact('users', 'books'));
    }
    public function createrent()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $books = Book::all();
        return view('rents.createrent', compact('books'));
    }
    public function store(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        if (Auth::user()->role != 'admin') {
            $request->validate([
                'start_date'  =>   'required',
                'end_date'  =>   'required',
                'book_id'  =>   'required',
            ]);
            Rent::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => Auth::id(),
                'book_id' => $request->book_id,
            ]);
            return 'created rent';
        }
        else {
            $request->validate([
                'start_date'  =>   'required',
                'end_date'  =>   'required',
                'user_id'  =>   'required',
                'book_id'  =>   'required',
            ]);
            Rent::create([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
            ]);
            return redirect()->route('rents.index');
        }
    }

    public function restore($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $rent = Rent::findOrFail($id);
        $rent->update([
            'restore_date' => date("Y-m-d")
        ]);
        return redirect()->route('rents.index');
    }
}
