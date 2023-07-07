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

        return view('frontend.index', compact('sliders', 'categories'));
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

}
