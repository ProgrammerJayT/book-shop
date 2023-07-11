<?php

namespace App\Http\Livewire\Frontend\Cart;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount;

    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount()
    {
        if (Auth::check()) {
            return $this->cartCount = CartItem::where('user_id', auth()->user()->user_id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.cart.cart-count',[
            'cartCount' => $this->cartCount
        ]);
    }
}
