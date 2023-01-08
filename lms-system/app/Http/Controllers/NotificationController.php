<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Notification;
use App\Notifications\RentTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
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
        $notifications = Notification::where('user_id',Auth::id())->get();
        return view('users.notifications',compact('notifications'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $user = User::where('id',$request->user_id)->get();
        $book_name = Book::findOrFail($request->book_id)->name;

        Notification::create([
            'type'=>'Rent Time',
            'data'=>"Please restore the book \"{$book_name}\" before the rent time is over",
            'user_id'=>$user[0]->id,
            ]);
        return redirect()->route('rents.index')->with('success', 'Sent Notification to user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        Notification::destroy($id);
        return redirect()->route('notifications.index');
    }
}
