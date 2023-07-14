@extends('layouts.app')

@section('title', 'My Books')

@section('content')
<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">My Books
                        <a href="{{url('books/create')}}" class="btn btn-sm btn-secondary float-end">Add Book</a>
                    </h4>
                    <hr>

                    <div class="table-responsive" id="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Edition</th>
                                    <th>Author</th>
                                    <th>Price</th>
                                    <th>Status</th>
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
                                    <td>{{$book->status == 1 ? 'Approved':'Pending'}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Books Found...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{$books->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection