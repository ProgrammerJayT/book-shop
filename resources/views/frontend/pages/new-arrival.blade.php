@extends('layouts.app')

@section('title', 'New Arrival Books')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-decoration-underline">New Arrivals:</h4>
            </div>
            @forelse ($newArrivalBooks as $book)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-success">In Stock</label>
                        @if ($book->bookImages->count() > 0)   
                        <img src="{{asset($book->bookImages[0]->url)}}" alt="{{$book->name}}">
                        @endif
                    </div>
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

                        <p>{{$book->description}}</p>
                        <div>
                            <span class="selling-price">R{{$book->price}}</span>
                        </div> 
                        <div class="mt-2 d-flex justify-content-center">
                            <a href="{{url('category/'.$book->category_id)}}" class="btn btn-outline-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12 p-2">
                <h4>No New Arrival Books Availbale</h4>
            </div>
            @endforelse
            
        </div>
    </div>
</div> 
@endsection