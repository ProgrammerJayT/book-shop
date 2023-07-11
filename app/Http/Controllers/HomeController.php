<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = SiteSetting::where('status', '0')->get();
        $categories = Category::where('status', '0')->get();
        return view('home', compact('categories', 'sliders'));
    }
}
