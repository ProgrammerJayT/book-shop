<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Category User</h1>
            <button type="button" class="btn-close" wire:click="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeCategory">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" wire:model.defer="name" placeholder="name" class="form-control" required>
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Status</label><br/>
                    <input type="checkbox" wire:model.defer="status"> checked=hidden, unchecked=visible
                    @error('status')
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
<div wire:ignore.self class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="content-mod">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
            <button type="button" class="btn-close" wire:click="closeModal"  data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div> Loading....
        </div>
        <div wire:loading.remove>
            <form wire:submit.prevent="updateCategory">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Status</label><br/>
                        <input type="checkbox" wire:model.defer="status"> checked=hidden, unchecked=visible
                        @error('status')
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
<div wire:ignore.self class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form wire:submit.prevent="destroyCategory">
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