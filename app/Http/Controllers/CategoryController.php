<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();
        return view('category', compact('categories'));

    }

    public function add(Request $request) {
        return view('category-add');

    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::create($request->all());
        return redirect('categories');

    }
}
