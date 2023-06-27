<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeUser">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" wire:model.defer="name" placeholder="name" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" wire:model.defer="email" placeholder="email" class="form-control" required>
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" wire:model.defer="password" placeholder="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Role</label>
                    <select wire:model.defer="role_as" class="form-control" required>
                        <option>Select Role</option>
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                    </select>
                    @error('role')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-txt">Save</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
            <button type="button" class="btn-close" wire:click="closeModal"  data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading....
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="updateUser">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" wire:model.defer="email" class="form-control">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" wire:model.defer="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select wire:model.defer="role_as" class="form-control">
                            <option value="">Select Role</option>
                            <option value="1" {{$role_as == '1' ? 'selected':'' }}>Admin</option>
                            <option value="0" {{$role_as == '0' ? 'selected':'' }}>User</option>
                        </select>
                        @error('role')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-txt">Update</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
            <button type="button" class="btn-close" wire:click="closeModal"  data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading....
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="destroyUser">
                <div class="modal-body">
                    <h6>Are you sure you want to delete this data?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-txt">Yes. Delete</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>