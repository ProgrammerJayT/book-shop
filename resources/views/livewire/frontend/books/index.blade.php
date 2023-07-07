<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card mt-3">
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"/> High to Low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"/> Low to High
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">{{$categoryById->name}} Book(s)</h4>
                </div>
                @forelse ($books as $book)
                <div class="col-md-4">
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
                                <button type="button" wire:click="addToCart({{$book->book_id}})" class="btn btn1">
                                    <i class="fa fa-shopping-cart"></i>  Add To Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="py-2">
                        <h4>No Books Availbale for {{$categoryById->name}}</h4>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
