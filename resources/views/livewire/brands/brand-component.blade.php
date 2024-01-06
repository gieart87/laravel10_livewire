<div>
    <div class="card mt-5">
        <div class="card-header">
            <h3>Brands</h3>
        </div>
        <div class="card-body">
            <p>
                <button wire:click="create" type="button" class="btn btn-primary">Create</button>
            </p>
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Brand</td>
                        <td>Description</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>{{ $brand->description }}</td>
                        <td>
                            <button wire:click="edit({{ $brand->id }})" class="btn btn-sm btn-primary">Edit</button>
                            <button wire:click="delete({{ $brand->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this?') || event.stopImmediatePropagation()">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <p>No Brand found</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($isModalOpen)
    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit="{{ $brandID ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input wire:model="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name here">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Description here"></textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ $brandID ? 'Update' : 'Create' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif
</div>