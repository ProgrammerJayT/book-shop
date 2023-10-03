<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
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
        $items = Item::orderBy('item_id', 'Desc')->paginate(5);
        return view('admin.item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.item.create', compact('categories'));
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
            } else {
                $status = '0';
            }
            $item = $category->items()->create([
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

        return redirect('admin/items')->with($notification);
    }

    public function edit(int $item_id)
    {
        $categories = Category::all();
        $item = Item::findOrFail($item_id);
        return view('admin.item.edit', compact('categories', 'item'));
    }

    public function update(BookFormRequest $request, int $item_id)
    {
        $validatedData = $request->validated();
        $item = Category::findOrFail($validatedData['category_id'])
            ->items()->where('item_id', $item_id)->first();
        if ($item) {
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
            if (Auth::user()->role_as == '1' && $item->status == '1' && $item->user->role_as == '1') {
                $status = $item->status;
            } else {
                $status = $request->status;
            }

            $item->update([
                'category_id' => $validatedData['category_id'],
                'user_id' => $item->user_id,
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'edition' => $edition,
                'author' => $validatedData['author'],
                'price' => $validatedData['price'],
                'status' => $status == true ? '1' : '0',
                'featured' => $request->featured == true ? '1' : '0',
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
                'message' => 'Item Updated Successfully'
            );
        } else {
            $notification = array(
                'message' => 'No such item Id Found'
            );
        }
        return redirect('admin/items')->with($notification);
    }

    public function destroyImage(int $item_image_id)
    {
        $itemImage = BookImage::findOrFail($item_image_id);
        if ($itemImage) {
            if (File::exists($itemImage->url)) {
                File::delete($itemImage->url);
            }
            $notification = array(
                'message' => 'Item Image Deleted'
            );
        } else {
            $notification = array(
                'message' => 'Item Image Already Removed'
            );
        }
        $itemImage->delete();
        return redirect()->back()->with($notification);
    }

    public function destroy(int $item_id)
    {
        $item = Item::findOrFail($item_id);
        if ($item) {
            if ($item->itemImages) {
                foreach ($item->itemImages as $image) {
                    if (File::exists($image->url)) {
                        File::delete($image->url);
                    }
                }
            }
            $item->delete();
            $notification = array(
                'message' => 'Item Deleted Successfully',
            );
        } else {
            $notification = array(
                'message' => 'Item Already Deleted'
            );
        }
        return redirect()->back()->with($notification);
    }
}
