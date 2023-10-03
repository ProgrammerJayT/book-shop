<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
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
        $newArrivalBooks = Item::latest()->take(14)->get();

        return view('frontend.index', compact('sliders', 'categories', 'newArrivalBooks'));
    }

    public function searchBooks(Request $request)
    {
        if ($request->search) {
            $categories = Category::where('status', '0')->get();
            $searchBooks = Item::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('categories','searchBooks'));
        } else {
            return redirect()->back()->with('error', [
                'message' => "Empty Search",
            ]);
        }
    }

    public function newArrival()
    {
        $categories = Category::where('status', '0')->get();
        $newArrivalBooks = Item::latest()->take(16)->get();
        return view('frontend.pages.new-arrival', compact('categories','newArrivalBooks'));
    }

    public function featuredBooks()
    {
        $categories = Category::where('status', '0')->get();
        $featuredBooks = Item::where('featured', '1')->latest()->get();
        return view('frontend.pages.featured-items', compact('categories', 'featuredBooks'));
    }

    public function category($category)
    {
        $categories = Category::where('status', '0')->get();
        $categoryById = Category::where('category_id',$category)->first();
        if ($categoryById) {
            return view('frontend.items.index', compact('categories', 'categoryById'));
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
