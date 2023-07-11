@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success mt-3">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Order Details</h4>
            </div>
            <div class="card-body" id="card-body">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                        <a href="{{url('admin/orders')}}" class="btn btn-sm btn-secondary float-end">Back</a>
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
                                        @if ($item->book->bookImages)
                                        <img src="{{asset($item->book->bookImages[0]->url)}}" 
                                            style="width: 50px; height: 50px" alt="">
                                        @else
                                        <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                    </td>
                                    <td width="10%">{{$item->book->name}}</td>
                                    <td width="10%">{{$item->book->edition}}</td>
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
        <div class="card border mt-3">
            <div class="card-body" id="card-body">
                <h4>Order Process (Order Status Update)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{url('admin/orders/'.$order->order_id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <label>Update Order Status</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="">Select Order Status</option>
                                    <option value="In Progress" {{Request::get('status') == 'In Progress' ? 'selected':''}}>In Progress</option>
                                    <option value="Collected" {{Request::get('status') == 'Collected' ? 'selected':''}}>Collected</option>
                                    <option value="Pending" {{Request::get('status') == 'Pending' ? 'selected':''}}>Pending</option>
                                    <option value="Cancelled" {{Request::get('status') == 'Cancelled' ? 'selected':''}}>Cancelled</option>  
                                </select>
                                <button type="submit" class="btn btn-primary btn-txt">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection