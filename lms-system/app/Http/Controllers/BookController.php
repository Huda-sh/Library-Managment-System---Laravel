<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use App\Models\Category;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

class BookController extends Controller
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
        $books = Book::all();
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }
    public function browseBooks()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $books = Book::all();
        $categories = Category::all();

        return view('books.browseBooks', compact('books', 'categories'));
    }
    public function booksByCategory($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        if ($id == 0) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('books.index');
            }
            return redirect()->route('books.browseBooks');
        }
        $books = Category::findOrFail($id)->books;
        $categories = Category::all();
        if (Auth::user()->role == 'admin') {
            return view('books.index', compact('books', 'categories'));
        }
        return view('books.browseBooks', compact('books', 'categories'));
    }
    public function search(Request $request)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $books = Book::where('name', 'like', '%' . $request->search . '%')->get();
        $categories = Category::all();
        if (Auth::user()->role == 'admin') {
            return view('books.index', compact('books', 'categories'));
        }
        return view('books.browseBooks', compact('books', 'categories'));
    }
    public function addToCart(Request $request, $id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        CartItem::create([
            'user_id' => Auth::user()->id,
            'book_id' => $id,
        ]);
        return redirect()->route('books.browseBooks')->with('success', 'Added item to cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $categories = Category::all();
        return view('books.create', compact('categories'));
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
        $request->validate([
            'name'  =>   'required',
            'author'  =>   'required',
            'date'  =>   'required',
            'price'  =>   'required',
            'category_id'  =>   'required',
        ]);
        Book::create([
            'name' => $request->name,
            'author' => $request->author,
            'date' => $request->date,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('books.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $book = Book::findorFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $request->validate([
            'name'  =>   'required',
            'author'  =>   'required',
            'date'  =>   'required',
            'price'  =>   'required',
            'category_id'  =>   'required',
        ]);
        $book = Book::findorFail($id);
        $book->update([
            'name' => $request->name,
            'author' => $request->author,
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        Book::destroy($id);

        return redirect()->route('books.index');
    }
}
