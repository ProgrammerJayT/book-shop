@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Site
                    <a href="{{url('admin/sites')}}" class="btn btn-sm btn-secondary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <form action="{{url('admin/sites')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" name="title" placeholder="title" value="{{old('title')}}" class="form-control mt-2" required>
                            @error('title')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" placeholder="description" class="form-control mt-2" rows="4" required></textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Status</label><br/>
                            <input type="checkbox" name="status">  checked=hidden, unchecked=visible
                            @error('status')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control mt-2" required />
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
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