<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();
        return view('book', compact('books'));
    }

    public function add() {
        $categories = Category::all();
        return view('book-add', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255'
        ]);

        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('public/cover', $newName);
        }

        $request['cover'] = $newName;
        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book Added Successfull');
    }

    public function edit($slug) {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('book-edit', compact('book', 'categories'));
    }

    public function update(Request $request, $slug) {
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('public/cover', $newName);
            $request['cover'] = $newName;
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('books')->with('status', 'Book Updated Successfull');
    }
}
