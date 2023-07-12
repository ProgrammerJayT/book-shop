<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Category;
use App\Models\BookImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\BookFormRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('book_id', 'Desc')->paginate();
        return view('admin.book.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.book.create', compact('categories'));
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
            if (Auth::user()->role_as = 1) {
                $status = '1';
            }else{
                $status = '0';
            }
            $book = $category->books()->create([
                'category_id' => $validatedData['category_id'],
                'user_id' => Auth::user()->user_id,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'edition' => $edition,
                'author' => $validatedData['author'],
                'price' => $validatedData['price'],
                'status' => $status,
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

        return redirect('admin/books')->with($notification);
    }

    public function edit(int $book_id)
    {
        $categories = Category::all();
        $book = Book::findOrFail($book_id);
        return view('admin.book.edit', compact('categories', 'book'));
    }

    public function update(BookFormRequest $request, int $book_id)
    {
        $validatedData = $request->validated();
        $book = Category::findOrFail($validatedData['category_id'])
                ->books()->where('book_id', $book_id)->first();
        if ($book) {
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
            if (Auth::user()->role_as == '1' && $book->status == '1' && $book->user->role_as == '1') {
                $status = $book->status;
            } else {
                $status = $request->status;
            }

            $book->update([
                'category_id' => $validatedData['category_id'],
                'user_id' => $book->user_id,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'edition' => $edition,
                'author' => $validatedData['author'],
                'price' => $validatedData['price'],
                'status' => $status == true ? '1':'0',
                'featured' => $request->featured == true ? '1':'0',
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = 'uploads/book_images/' . $book->book_id . '/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;

                    $book->bookImages()->create([
                        'book_id' => $book->book_id,
                        'url' => $finalImagePathName,
                    ]);
                }
            }
            $notification = array(
                'message' => 'Book Updated Successfully'
            );

        } else {
            $notification = array(
                'message' => 'No such Book Id Found'
            );
        }
        return redirect('admin/books')->with($notification);
    }

    public function destroyImage(int $book_image_id)
    {
        $bookImage = BookImage::findOrFail($book_image_id);
        if ($bookImage) {
            if (File::exists($bookImage->url)) {
                File::delete($bookImage->url);
            }
            $notification = array(
                'message' => 'Book Image Deleted'
            );
        } else {
            $notification = array(
                'message' => 'Book Image Already Removed'
            );
        }
        $bookImage->delete();
        return redirect()->back()->with($notification);
    }

    public function destroy(int $book_id)
    {
        $book = Book::findOrFail($book_id);
        if ($book) {
            if ($book->bookImages) {
                foreach ($book->bookImages as $image) {
                    if (File::exists($image->url)) {
                        File::delete($image->url);
                    }
                }
            }
            $book->delete();
            $notification = array(
                'message' => 'Book Deleted Successfully',
            );
        } else {
            $notification = array(
                'message' => 'Book Already Deleted'
            );
        }
        return redirect()->back()->with($notification);
    }
}
