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
                    {{ __("You're logged in!") }}
                    <form action="/admin/categories" method="POST">
                        @csrf
                        @method('POST')
                        <label for="name" class="form-label"></label><input class="form-control" type="text"
                            name="name">
                        <label for="slug" class="form-label"></label><input class="form-control" type="text"
                            name="slug">
                        <label for="icon" class="form-label"></label><input class="form-control" type="text"
                            name="icon">
                        <button type="submit" class="btn btn-primary">Tambah Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
