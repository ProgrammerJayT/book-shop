<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SiteFormRequest;

class SiteController extends Controller
{
    public function index()
    {
        $sites = SiteSetting::orderBy('site_id', 'Desc')->paginate();
        return view('admin.site.index', compact('sites'));
    }

    public function create()
    {
        return view('admin.site.create');
    }

    public function store(SiteFormRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/sites/'.Auth::user()->user_id.'/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move($uploadPath,$filename);
            $finalPathImage = $uploadPath.$filename;

            SiteSetting::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'url' => $finalPathImage,
                'status' => $request->status == true ? '1' : '0',
            ]);
            $notification = array(
                'message' => 'Site Created Successfully',
            );
        } else {
            $notification = array(
                'message' => 'No Image Found'
            );
        }
        return redirect('admin/sites')->with($notification);
    }

    public function edit(SiteSetting $site)
    {
        return view('admin.site.edit', compact('site'));
    }

    public function update(SiteFormRequest $request, SiteSetting $site)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $destination = $site->url;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $uploadPath = 'uploads/sites/' . Auth::user()->user_id . '/';
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move($uploadPath, $filename);
            $finalPathImage = $uploadPath . $filename;

            SiteSetting::where('site_id', $site->site_id)->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'url' => $finalPathImage,
                'status' => $request->status == true ? '1' : '0',
            ]);
            $notification = array(
                'message' => 'Site Updated Successfully',
            );
        } else {
            SiteSetting::where('site_id', $site->site_id)->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'status' => $request->status == true ? '1' : '0',
            ]);
            $notification = array(
                'message' => 'Site Updated Successfully',
            );
        }
        return redirect('admin/sites')->with($notification);
    }

    public function destroy(SiteSetting $site)
    {
        if ($site->count() > 0) {
            $destination = $site->url;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $site->delete();
            $notification = array(
                'message' => 'Site Deleted Successfully'
            );
        } else {
            $notification = array(
                'message' => 'something went wrong'
            );
        }
        return redirect('admin/sites')->with($notification);
    }
}
