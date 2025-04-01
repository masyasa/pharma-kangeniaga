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
                            <div><label for="icon" class="block text-sm font-medium text-gray-600">Icon
                                    :</label><input
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    type="text" name="icon"></div>
                            <div class="text-center "><button type="submit"
                                    class="mt-4 w-56 px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Tambah
                                    Category</button></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
