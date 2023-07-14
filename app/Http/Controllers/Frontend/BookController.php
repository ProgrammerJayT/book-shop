<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookFormRequest;

class BookController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $books = Book::where('user_id', auth()->user()->user_id)->orderBy('book_id', 'Desc')->paginate(5);

        return view('frontend.books.view', compact('categories', 'books'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('frontend.books.create', compact('categories'));
    }
    public function store(BookFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        if ($category) {
            switch ($validatedData['edition']) {
                case 1:
                    $edition = '1st';
                    break;
                case 2:
                    $edition = '2nd';
                    break;
                case 3:
                    $edition = '3rd';
                    break;
                case 4:
                    $edition = '4th';
                    break;
                default:
                    $notification = array(
                        'message' => 'Edition Failed, please select only number from 1 up to 4'
                    );
                    break;
            }
            $book = $category->books()->create([
                'category_id' => $validatedData['category_id'],
                'user_id' => Auth::user()->user_id,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'edition' => $edition,
                'author' => $validatedData['author'],
                'price' => $validatedData['price'],
                'status' => '0',
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/book_images/'.$book->book_id.'/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath.$filename;

                    $book->bookImages()->create([
                        'book_id' => $book->book_id,
                        'url' => $finalImagePathName,
                    ]);
                }
            }
            $notification = array(
                'message' => 'Book Created Successfully'
            );
        }else {
            $notification = array(
                'message' => 'Category does not exist'
            );
        }

        return redirect('/sell-book')->with($notification);
    }
}
