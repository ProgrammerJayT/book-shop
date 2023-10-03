<?php

namespace App\Http\Livewire\Frontend\Books;

use App\Models\Item;
use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $items, $categories, $categoryById, $priceInput;
    
    protected $queryString = [
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function addToCart(int $itemId)
    {
        if (Auth::check()) {
            if ($this->items->where('item_id', $itemId)->where('status', '0')) {
                $item = $this->items->where('item_id', $itemId)->first();
                if ($this->items->where('name', $item->name)->count() > 0) {
                    if (CartItem::where('user_id', auth()->user()->user_id)->where('item_id', $itemId)->exists()) {
                        $this->dispatchBrowserEvent('error',[
                            'message' => 'Book Already Added to Cart'
                        ]);
                    } else {
                        CartItem::create([
                            'user_id' => auth()->user()->user_id,
                            'item_id' => $itemId,
                            'quantity' => '1',
                        ]);
                        $this->emit('CartAddedUpdated');
                        $this->dispatchBrowserEvent('success', [
                            'message' => 'Book Added to Cart',
                        ]);
                    }
                } else {
                    $this->dispatchBrowserEvent('warning', [
                        'message' => 'Only '.$this->items->where('name', $item->name)->count().' item(s) available',
                    ]);
                }
            } else {
                $this->dispatchBrowserEvent('error', [
                    'message' => "Book does not exists",
                ]);
            } 
        } else {
            $this->dispatchBrowserEvent('info',[
                'message' => "Please Login to add to cart",
            ]);
        }
        
    }

    public function mount($categories, $categoryById)
    {
        $this->categories = $categories;
        $this->categoryById = $categoryById;
    }

    public function render()
    {
        $this->items = Book::where('category_id', $this->categoryById->category_id)
                            ->when($this->priceInput, function($q){
                                $q->when($this->priceInput == 'high-to-low', function($q2){
                                    $q2->orderBy('price', 'DESC');
                                })
                                ->when($this->priceInput == 'low-to-high', function($q2){
                                    $q2->orderBy('price', 'ASC');
                                });
                            })
                            ->where('status', '1')->get();
        return view('livewire.frontend.items.index',[
            'items' => $this->items,
            'categories' => $this->categories,
            'categoryById' => $this->categoryById,
        ]);
    }
}
