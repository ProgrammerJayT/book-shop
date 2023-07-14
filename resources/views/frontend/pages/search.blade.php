@extends('layouts.app')

@section('title', 'Search Books')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4 class="text-decoration-underline">Search Results:</h4>
            </div>
            @forelse ($searchBooks as $book)
            <div class="col-md-10">
                <div class="product-card">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="product-card-img">
                                <label class="stock bg-success">In Stock</label>
                                @if ($book->bookImages->count() > 0)   
                                <img src="{{asset($book->bookImages[0]->url)}}" alt="{{$book->name}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="product-card-body">
                                <h5 class="product-name text-primary text-uppercase">
                                    {{$book->name}}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 inline-block">
                                        <h6>Author:<br><span class="text-secondary">{{$book->author}}</span></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Edition:<br><span class="text-secondary">{{$book->edition}}</span></h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 inline-block">
                                        <span class="selling-price">R{{$book->price}}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="height: 45px; overflow:hidden;">
                                            <b>Description:</b><br><span class="text-secondary">{{$book->description}}</span>
                                        </p>
                                    </div>
                                </div>
                                <a href="{{url('category/'.$book->category_id)}}" class="btn btn-outline-primary">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2">
                <h4>No Such Book Found...</h4>
            </div>
            @endforelse
            <div class="col-md-10">
                {{$searchBooks->appends(request()->input())->links()}}
            </div>
        </div>
    </div>
</div> 
@endsection