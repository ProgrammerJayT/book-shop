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
                                                {{-- <button type="button" wire:loading.attr="disabled" class="btn btn-warning">Pay Now (Online Payment)</button> --}}
                                                <div >
                                                    <div id="paypal-button-container"></div>
                                                </div>
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

@push('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AeVVl8XAbIGmUyhgUASTv2smUT4Xv_Axs1r8jU_4pxyRdr5bX9jkTW2ZNdL0yN-sepb8SEFKO1PgZgWw&currency=USD"></script>
    <script>
      paypal.Buttons({
        onClick()  {

            // Show a validation error if the checkbox is not checked
            if (!document.getElementById('fullname').value
                || !document.getElementById('email').value
                || !document.getElementById('phone').value
                || !document.getElementById('address').value
                || !document.getElementById('zipcode').value
            ) 
            {
                Livewire.emit('validationForAll');
                return false;
            }else{
                @this.set('fullname', document.getElementById('fullname').value);
                @this.set('email', document.getElementById('email').value);
                @this.set('phone', document.getElementById('phone').value);
                @this.set('address', document.getElementById('address').value);
                @this.set('zipcode', document.getElementById('zipcode').value);
            }
        },
        // Order is created on the server and the order id is returned
        createOrder() {
          return fetch("/my-server/create-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product skus and quantities
            body: JSON.stringify({
              cart: [
                {
                  sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                  quantity: "YOUR_PRODUCT_QUANTITY",
                },
              ],
            }),
          })
          .then((response) => response.json())
          .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
          return fetch("/my-server/capture-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          })
          .then((response) => response.json())
          .then((orderData) => {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  window.location.href = 'thank_you.html';
          });
        }
      }).render('#paypal-button-container');
    </script>
@endpush