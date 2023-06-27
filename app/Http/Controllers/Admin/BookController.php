<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('book_id', 'Desc')->paginate(5);
        return view('admin.book.index', compact('books'));
    }
}
