<?php

namespace App\Http\Controllers\Frontend;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = SiteSetting::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }
}
