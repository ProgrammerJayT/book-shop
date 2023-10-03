@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <h6 class="alert alert-success">{{session('message')}}</h6>
        @endif
        <div class="me-md-3 me-xl-5">
            <h2>Dashboard</h2>
            <p class="mb-md-0">Your analytics dashboard</p>
            <hr>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>All Users</label>
                    <h1>{{$totalAllUsers}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Total Normal Users</label>
                    <h1>{{$totalUserU}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>Total Administrators</label>
                    <h1>{{$totalUserA}}</h1>
                    <a href="{{url('admin/users')}}" class="text-white">view</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Categories</label>
                    <h1>{{$totalCategories}}</h1>
                    <a href="{{url('admin/categories')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Total Books</label>
                    <h1>{{$totalBooks}}</h1>
                    <a href="{{url('admin/items')}}" class="text-white">view</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card card-body bg-primary text-white mb-3">
                    <label>Total Orders</label>
                    <h1>{{$totalOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-success text-white mb-3">
                    <label>Today Orders</label>
                    <h1>{{$todayOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-warning text-white mb-3">
                    <label>This Month Orders</label>
                    <h1>{{$thisMonthOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body bg-danger text-white mb-3">
                    <label>This Year Orders</label>
                    <h1>{{$thisYearOrders}}</h1>
                    <a href="{{url('admin/orders')}}" class="text-white">view</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection