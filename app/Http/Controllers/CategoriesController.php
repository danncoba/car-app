<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function newAction()
    {
        return view('categories.new');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'ime' => 'required|string|max:255|min:3'
        ]);
        $ime = $request->get('ime');
        Category::create([
            'ime' => $ime,
        ]);
        return redirect()->route('categories');
    }

    public function update(Request $request, $category)
    {
        $this->validate($request, [
            'ime' => 'required'
        ]);
        $cat = Category::find($category);
        $cat->ime = $request->get('ime');
        $cat->save();
        return redirect()->route('categories');
    }

    public function delete($category)
    {
        $cat = Category::find($category);
        $cat->delete();
        return redirect()->route('categories');
    }

}
