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
        return redirect('categories')->with('status', 'Category Added Successfull');
    }

    public function edit($slug) {
        $category = Category::where('slug', $slug)->first();
        return view('category-edit', compact('category'));
    }

    public function update(Request $request, $slug) {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('categories')->with('status', 'Category Updated Successfull');
    }

    public function delete($slug) {
        $category = Category::where('slug', $slug)->first();
        return view('category-delete', compact('category'));
    }

    public function destroy($slug) {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('categories')->with('status', 'Category Deleted Successfull');
    }
}
