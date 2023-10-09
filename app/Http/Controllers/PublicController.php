<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Book::query();

        if ($request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $books = $query->get();

        return view('book-list', compact('books', 'categories'));
    }
}
