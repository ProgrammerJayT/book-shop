<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <h4>My Cart</h4>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Books</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($cart as $cartItem)
                        @if ($cartItem->book)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <label class="product-name text-primary text-uppercase">
                                        @if ($cartItem->book->bookImages)
                                        <img src="{{asset($cartItem->book->bookImages[0]->url)}}" 
                                            style="width: 50px; height: 50px" alt="">
                                        @else
                                        <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                        {{$cartItem->book->name}} : 
                                        <span class="text-secondary text-lowercase" style="font-size: 10px;">
                                            {{$cartItem->book->edition}} edition</span>
                                    </label>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price">R{{$cartItem->book->price}}</label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{$cartItem->cart_item_id}})" class="btn btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{$cartItem->quantity}}" class="input-quantity" />
                                            <button type="button" wire:loading.attr="disabled" wire:click="incrementQuantity({{$cartItem->cart_item_id}})" class="btn btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 my-auto">
                                    <label class="price">R{{$cartItem->book->price * $cartItem->quantity }}</label>
                                    @php $totalPrice += $cartItem->book->price * $cartItem->quantity @endphp
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{$cartItem->cart_item_id}})" class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire:target="removeCartItem({{$cartItem->cart_item_id}})">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                            <span wire:loading wire:target="removeCartItem({{$cartItem->cart_item_id}})">
                                                <i class="fa fa-trash"></i> Removing
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        @endif   
                        @empty
                        <div class="text-center">No Cart Items available</div>
                        @endforelse                               
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 my-md-auto mt-3">
                    <h4>
                        Get the best Deals & Offers <a href="{{url('/')}}">Shop Now</a>
                    </h4>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h5>Total:
                            <span class="float-end">R{{$totalPrice}}</span>
                        </h5>
                        <hr>
                        <a href="{{url('/checkout')}}" class="btn btn-warning w-100">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
