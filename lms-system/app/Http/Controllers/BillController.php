<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
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
        $request->validate([
            'address'  =>   'required',
        ]);
        $total=0;
        $cart_items = User::findOrFail(Auth::id())->cartItems;
        foreach ($cart_items as $item) {
            $total+=$item->book->price;
        }
        $bill= Bill::create([
            'date'=>date("Y-m-d"),
            'address'=>$request->address,
            'total'=>$total,
            'user_id'=>Auth::id(),
        ]);
        foreach ($cart_items as $item) {
            BillItem::create([
                'bill_id'=>$bill->id,
                'book_id'=>$item->book->id,
            ]);
        }
        CartItem::where('user_id',Auth::id())->delete();
        return redirect()->route('bills.show',$bill->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $bill = Bill::findOrFail($id);
        return view('bills.show',compact('bill'));
    }
}
