<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Item;
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
        $items = Item::where('user_id', auth()->user()->user_id)->orderBy('item_id', 'Desc')->paginate(5);

        return view('frontend.items.view', compact('categories', 'items'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('frontend.items.create', compact('categories'));
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
            $item = $category->items()->create([
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
                $uploadPath = 'uploads/item_images/' . $item->item_id . '/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $extension;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . $filename;

                    $item->itemImages()->create([
                        'item_id' => $item->item_id,
                        'url' => $finalImagePathName,
                    ]);
                }
            }
            $notification = array(
                'message' => 'Item Created Successfully'
            );
        } else {
            $notification = array(
                'message' => 'Category does not exist'
            );
        }

        return redirect('/sell-item')->with($notification);
    }
}
