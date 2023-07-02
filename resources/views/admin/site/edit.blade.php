@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Site
                    <a href="{{url('admin/sites')}}" class="btn btn-sm btn-secondary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <form action="{{url('admin/sites/'.$site->site_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="title" value="{{$site->title}}" class="form-control mt-2" required>
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" placeholder="description" class="form-control mt-2" rows="4" required>{{$site->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br/>
                            <input type="checkbox" name="status" {{$site->status == '1' ? 'Checked':''}}>  checked=hidden, unchecked=visible
                            @error('status')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control mt-2"/>
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <img src="{{asset($site->url)}}" style="width:90px;height:90px;" class="me-4 border" alt="img" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end btn-txt">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection