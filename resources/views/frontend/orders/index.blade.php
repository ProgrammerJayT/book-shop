@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="mb-4">My Orders</h4>
                        <hr>

                        <div class="table-responsive" id="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order No</th>
                                        <th>Username</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($orders as $key=>$order)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->payment_mode}}</td>
                                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                        <a href="{{url('orders/'.$order->order_id)}}" class="btn btn-sm btn-primary btn-txt">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Orders Found....</td> 
                                </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="float-end">
                                {{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection