<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();
        $totalCategories = Category::count();
        $totalAllUsers = User::count();
        $totalUserU = User::where('role_as', '0')->count();
        $totalUserA = User::where('role_as', '1')->count();
        $totalOrders = Order::count();
        $todayDate = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        
        $todayOrders = Order::where('created_at','LIKE','%'.$todayDate.'%')->count();
        $thisMonthOrders = Order::where('created_at','LIKE','%'.$thisMonth.'%')->count();
        $thisYearOrders = Order::where('created_at', 'LIKE','%'.$thisYear.'%')->count();

        return view('admin.dashboard' , compact(
            'totalBooks','totalCategories','totalAllUsers','totalUserU',
            'totalUserA','totalOrders','todayOrders','thisMonthOrders','thisYearOrders'
        ));
    }
}
