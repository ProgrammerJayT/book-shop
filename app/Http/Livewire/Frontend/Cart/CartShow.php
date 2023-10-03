<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Book;
use Livewire\Component;
use App\Models\CartItem;

class CartShow extends Component
{
    public $categories, $cart, $totalPrice = 0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = CartItem::where('cart_item_id', $cartId)->where('user_id', auth()->user()->user_id)->first();
        if ($cartData) {
            $cartData->decrement('quantity');
        }else {
            $this->dispatchBrowserEvent('error', [
                'message' => "Something went wrong",
            ]);
        }
    }
    public function incrementQuantity(int $cartId)
    {
        $cartData = CartItem::where('cart_item_id', $cartId)->where('user_id', auth()->user()->user_id)->first();
        if ($cartData) {
            $cartBookName = $cartData->item->where('item_id', $cartData->item_id)->first();
            $itemsByEditionCount = Book::where('edition', $cartBookName->edition)->where('status','1')->where('name', $cartBookName->name)->count();
            if ($itemsByEditionCount > $cartData->quantity) {
               $cartData->increment('quantity'); 
            }else{
                $this->dispatchBrowserEvent('warning', [
                    'message' => 'Only '.$itemsByEditionCount.' item(s) available.',
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('error', [
                'message' => "Something went wrong",
            ]);
        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = CartItem::where('user_id', auth()->user()->user_id)->where('cart_item_id', $cartId)->first();
        if ($cartRemoveData) {
            $cartRemoveData->delete();
            $this->emit('CartAddedUpdated');
        } else {
            $this->dispatchBrowserEvent('error', [
                'message' => "Cart Already Deleted",
            ]);
        }   
    }

    public function mount($categories)
    {
        $this->categories = $categories;
    }
    
    public function render()
    {
        $this->cart = CartItem::where('user_id', auth()->user()->user_id)->get();

        return view('livewire.frontend.cart.cart-show',[
            'categories' => $this->categories,
            'cart' => $this->cart,
        ]);
    }
} 
