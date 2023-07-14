@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>Sites List
                    <a href="{{url('admin/sites/create')}}" class="btn btn-sm btn-secondary float-end">Add Site</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sites as $key=>$site)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$site->title}}</td>
                            <td>{{$site->description}}</td>
                            <td>
                                <img src="{{asset("$site->url")}}" style="width:70px;height:70px;" alt="site">
                            </td>
                            <td>{{$site->status == 1 ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{url('admin/sites/'.$site->site_id.'/edit')}}" class="btn btn-sm btn-primary btn-txt">Edit</a>
                                <a href="{{url('admin/sites/'.$site->site_id.'/delete')}}" onclick="return confirm('Are you sure, you want to delete this data?')" class="btn btn-sm btn-danger btn-txt">Delete</a>
                            </td>
                        </tr>   
                        @empty
                        <tr>
                            <td colspan="6" class="text-centerz">No Sites Found.....</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="float-end">
                    {{$sites->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection