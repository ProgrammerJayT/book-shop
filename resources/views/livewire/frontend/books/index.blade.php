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
                @forelse ($items as $item)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-card-img">
                            <label class="stock bg-success">In Stock</label>
                            @if ($item->itemImages->count() > 0)   
                            <img src="{{asset($item->itemImages[0]->url)}}" alt="{{$item->name}}">
                            @endif
                        </div>
                        <div class="product-card-body">
                            <h5 class="product-name text-primary text-uppercase">
                                {{$item->name}}
                            </h5>
                            <div class="row">
                                <div class="col-md-6 inline-block">
                                    <h6>Author:<br><span class="text-secondary">{{$item->author}}</span></h6>
                                </div>
                                <div class="col-md-6">
                                    <h6>Edition:<br><span class="text-secondary">{{$item->edition}}</span></h6>
                                </div>
                            </div>

                            <p>{{$item->description}}</p>
                            <div>
                                <span class="selling-price">R{{$item->price}}</span>
                            </div>
                            <div class="mt-2 d-flex justify-content-center">
                                <button type="button" wire:click="addToCart({{$item->item_id}})" class="btn btn1">
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
