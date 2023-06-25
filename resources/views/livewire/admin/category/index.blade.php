<div>
    @include('livewire.admin.category.form-modal')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Caregories List
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-sm btn-secondary float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body" id="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as  $key=>$category)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->status == 0 ? 'Visible':'Hidden'}}</td>
                                <td>
                                    <a href="#" wire:click="editCategory({{$category->category_id}})" data-bs-toggle="modal" data-bs-target="#updateCategoryModal" class="btn btn-primary btn-sm btn-txt">Edit</a>
                                    <a href="#" wire:click="deleteCategory({{$category->category_id}})" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" class="btn btn-danger btn-sm btn-txt">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Categories Found....</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="py-2 float-end">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addCategoryModal').modal('hide');
            $('#updateCategoryModal').modal('hide');
            $('#deleteCategoryModal').modal('hide');
        });
    </script>    
@endpush