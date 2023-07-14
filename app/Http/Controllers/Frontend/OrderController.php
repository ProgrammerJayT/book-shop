<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $orders = Order::where('user_id', Auth::user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.orders.index', compact('categories', 'orders'));
    }

    public function show($orderId)
    {
        $categories = Category::where('status', '0')->get();
        $order = Order::where('user_id', Auth::user()->user_id)->where('order_id', $orderId)->first();
        if ($order) {
            return view('frontend.orders.view', compact('categories', 'order'));
        } else {
            return redirect()->back()->with('error', [
                'message' => "Order Id Not Found",
            ]);
        }   
    }
}
