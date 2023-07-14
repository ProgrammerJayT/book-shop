<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileFormRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '0')->get();
        $user = User::where('user_id', auth()->user()->user_id)->first();
        return view('frontend.profile.index', compact('categories', 'user'));
    }

    public function update(ProfileFormRequest $request,int $userId)
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($userId);
        if ($userId) {
            if ($user->password == $validatedData['password']) {
                if ($user->name == $validatedData['name'] && $user->phone == $validatedData['phone'] &&
                    $user->address == $validatedData['address'] && $user->zip_code == $validatedData['zipcode']) {
                    $notification = array(
                        'message' => 'Nothing to update'
                    );
                } else {
                    $user->name = $validatedData['name'];
                    $user->phone = $validatedData['phone'];
                    $user->address = $validatedData['address'];
                    $user->zip_code = $validatedData['zipcode'];
                    $user->save();

                    $notification = array(
                        'message' => 'Profile Updated Successfully'
                    );
                }  
            } else {
                $user->name = $validatedData['name'];
                $user->phone = $validatedData['phone'];
                $user->address = $validatedData['address'];
                $user->zip_code = $validatedData['zipcode'];
                $user->password = $validatedData['password'];
                $user->save();

                $notification = array(
                    'message' => 'Profile Updated Successfully'
                );
            }
        } else {
            $notification = array(
                'message' => 'User does not exist'
            );
        }
        return redirect('/profile')->with($notification);
    }
}
