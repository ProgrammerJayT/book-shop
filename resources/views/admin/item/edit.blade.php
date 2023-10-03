@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Eidt Book
                    <a href="{{url('admin/items')}}" class="btn btn-sm btn-secondary float-end">Back</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <form action="{{url('admin/items/'.$item->item_id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Category</label>
                            <select name="category_id" class="form-control mt-2" required>
                                <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->category_id}}" {{$category->category_id == $item->category_id ? 'selected':''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Book Name</label>
                            <input type="text" name="name" placeholder="name" value="{{$item->name}}" class="form-control mt-2" required>
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Description</label>
                            <textarea name="description" placeholder="description" class="form-control mt-2" rows="4" required>{{$item->description}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Edition</label>
                            <input type="text" name="edition" placeholder="number" value="{{$item->edition}}" class="form-control mt-2" required>
                            @error('edition')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Author</label>
                            <input type="text" name="author" placeholder="Full name" value="{{$item->author}}" class="form-control mt-2" required>
                            @error('author')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="number" value="{{$item->price}}" class="form-control mt-2" required>
                            @error('price')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Featured</label><br/>
                            <input type="checkbox" name="featured" {{$item->featured == '1' ? 'checked':''}} style="width:50px;height:50;"/>
                            @error('featured')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                         <div class="col-md-6 mb-3">
                            <label>Status</label><br/>
                            <input type="checkbox" name="status" {{$item->status == '1' ? 'checked':''}} style="width:50px;height:50;"/> Unchecked=Pending, Checked=Approved
                            @error('status')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Book Images</label>
                            <input type="file" name="image[]" multiple class="form-control mt-2">
                            @error('image')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            @if ($item->itemImages) 
                            <div class="row">
                                @foreach ($item->itemImages as $image)    
                                <div class="col-md-2">
                                    <img src="{{asset($image->url)}}" style="width:90px;height:90px;" class="me-4 border" alt="img" />
                                    <a href="{{url('admin/item-image/'.$image->item_image_id.'/delete')}}" class="d-block">Remove</a>
                                </div>
                                @endforeach
                            </div> 
                            @else
                                <h4>No Image Added</h4>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary float-end btn-txt">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection