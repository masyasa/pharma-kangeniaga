<form wire:submit="add">
    @csrf
    @method('POST')
    <label for="name" class="form-label">Nama Kategori: </label><input type="text" wire:model="name">
    <div>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <label for="slug" class="form-label">Slug Kategori: </label><input type="text" wire:model="slug">
    <div>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <label for="icon" class="form-label">Icon: </label><input type="text" wire:model="icon">
    <div>
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>

    <button class="btn btn-primary" type="submit">Add Category</button>
</form>
