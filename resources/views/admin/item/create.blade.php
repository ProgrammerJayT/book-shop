@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Item
                    <a href="{{url('admin/items')}}" class="btn btn-sm btn-secondary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <form action="{{url('admin/items')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control mt-2" required>
                                <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Item Name</label>
                            <input type="text" name="name" placeholder="name" value="{{old('name')}}" class="form-control mt-2" required>
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Description</label>
                            <textarea name="description" placeholder="description" class="form-control mt-2" rows="4" required></textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Edition</label>
                            <input type="number" name="edition" placeholder="number" value="{{old('edition')}}" class="form-control mt-2" required>
                            @error('edition')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Author</label>
                            <input type="text" name="author" placeholder="Full name" value="{{old('author')}}" class="form-control mt-2" required>
                            @error('author')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="number" value="{{old('price')}}" class="form-control mt-2" required>
                            @error('price')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Item Images</label>
                            <input type="file" name="image[]" multiple class="form-control mt-2" required>
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