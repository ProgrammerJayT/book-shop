@extends('layouts.app')

@section('title', 'My Order Details')

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{url('orders')}}" class="btn btn-sm btn-secondary float-end">Back</a>
                        </h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <h6>Order Created Date: {{$order->created_at->format('d-m-Y')}}</h6>
                                <h6>Payment Mode: {{$order->payment_mode}}</h6>
                                <h6 class="mt-4">
                                    Order Satus: <span class="text-uppercase text-success border p-2">{{$order->status}}</span>
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h5>User Details</h5>
                                <hr>
                                <h6>Full Name: {{$order->user->name}}</h6>
                                <h6>Email Address: {{$order->user->email}}</h6>
                                <h6>Address: {{$order->address}}</h6>
                                <h6>Zip Code: {{$order->zip_code}}</h6>
                            </div>
                        </div>
                        <br/>
                        <h5>Order Items</h5>
                        <hr>
                        <div class="table-responsive" id="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item No</th>
                                        <th>Image</th>
                                        <th>Book</th>
                                        <th>Edition</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach ($order->orderItems as $key=>$item)
                                    <tr>
                                        <td width="10%">{{$key+1}}</td>
                                        <td width="10%">
                                            @if ($item->item->itemImages)
                                            <img src="{{asset($item->item->itemImages[0]->url)}}" 
                                                style="width: 50px; height: 50px" alt="">
                                            @else
                                            <img src="" style="width: 50px; height: 50px" alt="">
                                            @endif
                                        </td>
                                        <td width="10%">{{$item->item->name}}</td>
                                        <td width="10%">{{$item->item->edition}}</td>
                                        <td width="10%">R{{$item->price}}</td>
                                        <td width="10%">{{$item->quantity}}</td>
                                        <td width="10%" class="fw-bold">R{{$item->price * $item->quantity}}</td>
                                        @php
                                            $totalPrice += $item->price * $item->quantity;
                                        @endphp
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="6" class="fw-bold">Total Amount:</td>
                                        <td colspan="1" class="fw-bold">R{{$totalPrice}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection