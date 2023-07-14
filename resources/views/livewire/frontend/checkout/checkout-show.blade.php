<div>
    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>
            @if ($this->totalBookAmount != '0')
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Item Total Amount :
                                <span class="float-end text-secondary">R {{$this->totalBookAmount}}</span>
                            </h4>
                            <hr>
                            <small>* Items will be delivered in 3 - 5 days.</small>
                            <br/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="shadow bg-white p-3">
                            <h4 class="text-primary">
                                Basic Information
                            </h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Full Name</label>
                                    <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                    @error('fullname')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" wire:model.defer="phone" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                    @error('phone')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Address</label>
                                    <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                    @error('email')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Zip-code</label>
                                    <input type="number" wire:model.defer="zipcode" id="zipcode" class="form-control" placeholder="Enter Zip-code" />
                                    @error('zipcode')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Full Address</label>
                                    <textarea wire:model.defer="address" id="address" class="form-control" rows="2" ></textarea>
                                    @error('address')<small class="text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label class="mb-2">Select Payment Mode: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashTab-tab" data-bs-toggle="pill" data-bs-target="#cashTab" type="button" role="tab" aria-controls="cashTab" aria-selected="true">Cash</button>
                                            <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashTab" role="tabpanel" aria-labelledby="cashTab-tab" tabindex="0">
                                                <h6>Cash</h6>
                                                <hr/>
                                                <button type="button" wire:loading.attr="disabled" wire:click="cashOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="cashOrder"> 
                                                        Place Order (Cash)
                                                    </span>
                                                    <span wire:loading wire:target="cashOrder"> 
                                                        Placing Order
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>Online Payment</h6>
                                                <hr/>
                                                <button type="button" wire:loading.attr="disabled"wire:click="paidOnlineOrder" class="btn btn-warning">
                                                    <span wire:loading.remove wire:target="paidOnlineOrder"> 
                                                        Pay Now (Online Payment)
                                                    </span>
                                                    <span wire:loading wire:target="paidOnlineOrder"> 
                                                        Placing Order
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h5>No Items in Cart to Checkout</h5>
                    <a href="{{url('/')}}" class="btn btn-warning">Shop Now</a>
                </div>
            @endif
        </div>
    </div>
</div>
