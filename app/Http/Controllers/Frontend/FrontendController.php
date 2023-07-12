<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = SiteSetting::where('status', '0')->get();
        $categories = Category::where('status', '0')->get();
        $newArrivalBooks = Book::latest()->take(14)->get();

        return view('frontend.index', compact('sliders', 'categories', 'newArrivalBooks'));
    }

    public function newArrival()
    {
        $categories = Category::where('status', '0')->get();
        $newArrivalBooks = Book::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('categories','newArrivalBooks'));
    }

    public function featuredBooks()
    {
        $categories = Category::where('status', '0')->get();
        $featuredBooks = Book::where('featured', '1')->latest()->get();
        return view('frontend.pages.featured-books', compact('categories', 'featuredBooks'));
    }

    public function category($category)
    {
        $categories = Category::where('status', '0')->get();
        $categoryById = Category::where('category_id',$category)->first();
        if ($categoryById) {
            return view('frontend.books.index', compact('categories', 'categoryById'));
        } else {
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.thank-you', compact('categories'));
    }

}
