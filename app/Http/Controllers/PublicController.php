<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request) {
        $categories = Category::all();

        if ($request->category || $request->title) {
            // $books = Book::join('book_categorys', 'books.id', '=', 'book_categorys.book_id')
            // ->join('categories', 'book_categorys.category_id', '=', 'categories.id')
            // ->orWhere('books.title', '=', '%'.$request->title.'%')
            // ->orWhere('categories.id', '=', $request->category)
            // ->get();
            $books = Book::where('title', 'like', '%'.$request->title.'%')
                        ->orWhereHas('categories', function($q) use($request) {
                            $q->where('categories.id', $request->category);
                        })->get();
                       
            // $books = Book::whereHas('categories', function($q) use($request) {
            //     $q->where('categories.id', $request->category);
            // })->get();
        } else {
            $books = Book::all();
        }

        return view('book-list', compact('books', 'categories'));
    }
}
