<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeUser">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" wire:model.defer="name" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" wire:model.defer="email" class="form-control" required>
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" wire:model.defer="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Role Type</label>
                    <div class="col-sm-10">
                        <select wire:model.defer="role" class="form-control" id="exampleFormControlSelect1" required>
                            <option>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                    @error('role')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-txt">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>