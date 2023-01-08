<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function index()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $cart_items = User::findOrFail(Auth::id())->cartItems;
        return view('cartitems.index',compact('cart_items'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        CartItem::destroy($id);

        return redirect()->route('cartItems.index');
    }
}
