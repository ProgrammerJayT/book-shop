@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Orders List</h4>
            </div>
            <div class="card-body" id="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="mb-1">Filter by Date</label> 
                            <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d')}}" class="form-control">   
                        </div>
                        <div class="col-md-3">
                            <label class="mb-1">Filter by Status</label>
                            <select name="status" class="form-select">
                                <option value="">Select All Status</option>
                                <option value="In Progress" {{Request::get('status') == 'In Progress' ? 'selected':''}}>In Progress</option>
                                <option value="Collected" {{Request::get('status') == 'Collected' ? 'selected':''}}>Collected</option>
                                <option value="Pending" {{Request::get('status') == 'Pending' ? 'selected':''}}>Pending</option>
                                <option value="Cancelled" {{Request::get('status') == 'Cancelled' ? 'selected':''}}>Cancelled</option>
                            </select> 
                        </div>
                        <div class="col-md-6">
                            <br/>
                            <button type="submit" class="btn btn-primary btn-txt">Filter</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
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
                                <a href="{{url('admin/orders/'.$order->order_id)}}" class="btn btn-sm btn-primary btn-txt">View</a>
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
@endsection