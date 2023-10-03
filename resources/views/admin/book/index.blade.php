@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Books List
                    <a href="{{url('admin/items/create')}}" class="btn btn-sm btn-secondary float-end">Add Book</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Edition</th>
                            <th>Author</th>
                            <th>Price</th>
                            <th>Added By</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                            @if ($item->category)     
                                {{$item->category->name}}
                            @else
                                No category
                            @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->edition}}</td>
                            <td>{{$item->author}}</td>
                            <td>R{{$item->price}}</td>
                            <td>
                            @if ($item->user)
                                {{$item->user->name}}
                            @else
                                No user
                            @endif
                            </td>
                            <td>
                            @if ($item->user)
                                {{$item->user->email}}
                            @else
                                No user
                            @endif
                            </td>
                            <td>{{$item->status == 1 ? 'Approved':'Pending'}}</td>
                            <td>
                                <a href="{{url('admin/items/'.$item->item_id.'/edit')}}" class="btn btn-sm btn-primary btn-txt">Edit</a>
                                <a href="{{url('admin/items/'.$item->item_id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this data?')" class="btn btn-sm btn-danger btn-txt">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No Books Found...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end">
                    {{$items->links()}}
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection