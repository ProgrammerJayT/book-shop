<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

Auth::routes();

Route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function() {
    Route::get('/','index')->name('index');
    Route::get('/category/{category}', 'category');
    Route::get('/new-arrivals', 'newArrival');
    Route::get('/featured-items', 'featuredBooks');
    Route::get('/search', 'searchBooks');
});
Route::middleware(['auth'])->group(function() {
    Route::get('/cart', [App\Http\Controllers\Frontend\CartContoller::class, 'index']);
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutContoller::class, 'index']);
    Route::get('/orders', [App\Http\Controllers\Frontend\OrderController::class, 'index']);
    Route::get('/orders/{orderId}', [App\Http\Controllers\Frontend\OrderController::class, 'show']);

    Route::controller(App\Http\Controllers\Frontend\BookController::class)->group(function() {
        Route::get('/sell-item', 'index');
        Route::get('/items/create', 'create');
        Route::post('/items', 'store');
    });
    Route::controller(App\Http\Controllers\Frontend\ProfileController::class)->group(function() {
        Route::get('/profile', 'index');
        Route::put('/profile/update/{userId}', 'update');
    });
}); 
Route::get('/thank-you', [App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);  

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::controller(App\Http\Controllers\Admin\SiteController::class)->group(function() {
        Route::get('/sites', 'index');
        Route::get('/sites/create', 'create');
        Route::post('/sites', 'store');
        Route::get('/sites/{site}/edit', 'edit');
        Route::put('/sites/{site}', 'update');
        Route::get('/sites/{site}/delete', 'destroy');
    });
    Route::get('/users', App\Http\Livewire\Admin\User\Index::class);
    Route::get('/categories', App\Http\Livewire\Admin\Category\Index::class);
    Route::controller(App\Http\Controllers\Admin\BookController::class)->group(function() {
        Route::get('/items', 'index');
        Route::get('/items/create', 'create');
        Route::post('/items', 'store');
        Route::get('/items/{item}/edit', 'edit');
        Route::put('/items/{item}', 'update');
        Route::get('/items/{item_id}/delete', 'destroy');
        Route::get('/item-image/{item_image_id}/delete', 'destroyImage');
    });
    Route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function() {
        Route::get('/orders', 'index');
        Route::get('/orders/{orderId}', 'show');
        Route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
        Route::get('/invoice/{orderId}/mail', 'mailInvoice');
    });
});
