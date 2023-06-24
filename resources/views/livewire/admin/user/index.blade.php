<div>
    @include('livewire.admin.user.form-modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Users List
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-secondary btn-sm float-end">Add User</a>
                    </h4>
                </div>
                <div class="card-body" id="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key=>$user)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_as == 1 ? 'Admin':'User'}}</td>
                                <td>
                                    <a href="#" wire:click="editUser({{$user->user_id}})" data-bs-toggle="modal" data-bs-target="#updateUserModal" class="btn btn-sm btn-primary btn-txt">Edit</a>
                                @if (Auth::user()->email != $user->email)
                                    <a href="#" wire:click="deleteUser({{$user->user_id}})"  data-bs-toggle="modal" data-bs-target="#deleteUserModal" class="btn btn-sm btn-danger btn-txt">Delete</a>
                                @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Users Found....</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-2 float-end">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addUserModal').modal('hide');
            $('#updateUserModal').modal('hide');
            $('#deleteUserModal').modal('hide');
        });
    </script>    
@endpush