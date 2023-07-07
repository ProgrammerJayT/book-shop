<?php

namespace App\Http\Livewire\Frontend\Books;

use App\Models\Book;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $books, $categories, $categoryById, $priceInput;
    
    protected $queryString = [
        'priceInput' => ['except' => '', 'as' => 'price'],
    ];

    public function addToCart(int $bookId)
    {
        if (Auth::check()) {
            if ($this->books->where('book_id', $bookId)->where('status', '0')) {
                $book = $this->books->where('book_id', $bookId)->first();
                if ($this->books->where('name', $book->name)->count() > 0) {
                    # code...
                } else {
                    $this->dispatchBrowserEvent('warning', [
                        'message' => 'Only '.$this->books->where('name', $book->name)->count().' book(s) available',
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
        $this->books = Book::where('category_id', $this->categoryById->category_id)
                            ->when($this->priceInput, function($q){
                                $q->when($this->priceInput == 'high-to-low', function($q2){
                                    $q2->orderBy('price', 'DESC');
                                })
                                ->when($this->priceInput == 'low-to-high', function($q2){
                                    $q2->orderBy('price', 'ASC');
                                });
                            })
                            ->where('status', '1')->get();
        return view('livewire.frontend.books.index',[
            'books' => $this->books,
            'categories' => $this->categories,
            'categoryById' => $this->categoryById,
        ]);
    }
}
