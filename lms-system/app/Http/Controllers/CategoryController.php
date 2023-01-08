<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories = Category::all();
        // $categories = Category::get();

        return view('categories.index',compact('categories'));
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
        return view('categories.create');
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
        // $category = new Category();
        // $category->name = $request->name;
        // $category->save();

        // Category::create($request->all());

        // to use this way we need to put fillable in the model
        $request->validate([
            'name'  =>   'required',
        ]);
        Category::create([
            'name'=>$request->name,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $category = Category::findorFail($id);
        return view('categories.edit',compact('category'));
        // if ($category) {
        //     return $category;
        // }
        // else {
        //     return response('The category is not found');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        $request->validate([
            'name'  =>   'required',
        ]);
        $category = Category::findorFail($id);

        // $category->name = $request->name;
        // $category->save();

        $category->update([
            'name'=>$request->name
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::check()){
            return redirect()->route('auth.login')->with('success', 'you are not allowed to access');
        }
        // Category::findorFail($id)->delete();
        Category::destroy($id);

        return redirect()->route('categories.index');
    }
}
