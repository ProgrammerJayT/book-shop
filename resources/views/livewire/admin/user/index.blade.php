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
                            <tr>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addUserModal').modal('hide');
        });
    </script>    
@endpush