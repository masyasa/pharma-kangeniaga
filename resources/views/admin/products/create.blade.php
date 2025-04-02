<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    {{-- @livewire('form-add-category') --}}
                    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-md">
                        <form action="{{ route('admin.products.store') }}" method="POST">
                            @csrf
                            <div><label for="name" class="block text-sm font-medium text-gray-600">Nama
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="name"></div>
                            <div><label for="slug" class="block text-sm font-medium text-gray-600">Slug
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="slug"></div>
                            <div><label for="photo" class="block text-sm font-medium text-gray-600">Photo
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="photo"></div>
                            <div><label for="price" class="block text-sm font-medium text-gray-600">Price
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="price"></div>
                            <div><label for="about" class="block text-sm font-medium text-gray-600">About
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="about"></div>

                            <div>
                                <label for="about" class="block text-sm font-medium text-gray-600">Kategori
                                    :</label>
                                <select class="category-multiple" name="categories[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center "><button type="submit"
                                    class="mt-4 w-56 px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Tambah
                                    Produk</button></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
