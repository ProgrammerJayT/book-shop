@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
<div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <div class="shadow bg-white p-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>My Profile</h4>
                        </div>
                        <div class="card-body" id="card-body">
                            <form action="{{url('profile/update/'.$user->user_id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Name" value="{{$user->name}}" class="form-control mt-2" required>
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Phone</label>
                                        <input type="number" name="phone" placeholder="Phone" value="{{$user->phone}}" class="form-control mt-2" required>
                                        @error('phone')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Email" value="{{$user->email}}" class="form-control mt-2" readonly required>
                                        @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" placeholder="Password" value="{{$user->password}}" class="form-control mt-2" required>
                                        @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Address</label>
                                        <textarea name="address" placeholder="Address" class="form-control mt-2" rows="4" required>{{$user->address}}</textarea>
                                        @error('address')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Zip Code</label>
                                        <input type="number" name="zipcode" placeholder="Zip Code" value="{{$user->zip_code}}" class="form-control mt-2" required>
                                        @error('zipcode')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-6 mb-3">
                                        <label>Photo</label>
                                        <input type="file" name="image" class="form-control mt-2">
                                        <img src="{{asset('uploads/profile_images/'.$user->user_id.'/'.$user->url)}}" width="60px" height="60px" />
                                        @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary float-end btn-txt">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection