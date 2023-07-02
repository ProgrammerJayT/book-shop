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
                    <a href="{{url('admin/books/create')}}" class="btn btn-sm btn-secondary float-end">Add Book</a>
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
                        @forelse ($books as $key=>$book)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                            @if ($book->category)     
                                {{$book->category->name}}
                            @else
                                No category
                            @endif
                            </td>
                            <td>{{$book->name}}</td>
                            <td>{{$book->edition}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->price}}</td>
                            <td>
                            @if ($book->user)
                                {{$book->user->name}}
                            @else
                                No user
                            @endif
                            </td>
                            <td>
                            @if ($book->user)
                                {{$book->user->email}}
                            @else
                                No user
                            @endif
                            </td>
                            <td>{{$book->status == 1 ? 'Approved':'Pending'}}</td>
                            <td>
                                <a href="{{url('admin/books/'.$book->book_id.'/edit')}}" class="btn btn-sm btn-primary btn-txt">Edit</a>
                                <a href="{{url('admin/books/'.$book->book_id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this data?')" class="btn btn-sm btn-danger btn-txt">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No Books Found...</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection