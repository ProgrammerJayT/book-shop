@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Books List
                    <a href="" class="btn btn-sm btn-secondary float-end">Add Book</a>
                </h4>
            </div>
            <div class="card-body" id="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Edition</th>
                            <th>Author</th>
                            <th>Added By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($collection as $item) --}}
                        <tr>
                            <td></td>
                        </tr>
                        {{-- @empty --}}
                        <tr>
                            <td colspan="9" class="text-center">No Books Found...</td>
                        </tr>
                        {{-- @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection