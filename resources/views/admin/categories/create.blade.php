<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    {{-- @livewire('form-add-category') --}}
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div><label for="name" class="form-label">Nama :</label><input class="form-control"
                                type="text" name="name"></div>
                        <div><label for="icon" class="form-label">Icon :</label><input class="form-control"
                                type="text" name="icon"></div>

                        <button type="submit" class="btn btn-primary">Tambah Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
