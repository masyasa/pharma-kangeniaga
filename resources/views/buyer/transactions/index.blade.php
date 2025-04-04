<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="alert alert-danger" style="font-size: 12px">
                            Error:
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-danger" style="font-size: 12px">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-end mb-3">
                        <a class="bg-gray-100 border-b hover:bg-gray-200 btn btn-primary btn-sm me-2"
                            href="/transaksi-deleted">Deleted Transaction</a>
                        {{-- <a class="bg-gray-100 border-b hover:bg-gray-200 btn btn-primary btn-sm "
                            href="{{ route('admin.transactions.create') }}">Add Transaction</a> --}}
                    </div>
                </div>
            </div>
        </div>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}

                    <table class="min-w-full border-collapse  rounded-lg">
                        <thead>
                            <tr class="bg-gray-800 text-white rounded-t-lg text-center">
                                <th class="py-3 px-6">No.</th>
                                <th class="py-3 px-6">Nama</th>
                                <th class="py-3 px-6">Slug</th>
                                <th class="py-3 px-6">Icon</th>
                                <th class="py-3 px-6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                                <tr class="bg-gray-100 border-b hover:bg-gray-200 text-center">
                                    <td class="py-3 px-6 ">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-6 ">{{ $item->name }}</td>
                                    <td class="py-3 px-6 ">{{ $item->slug }}</td>
                                    <td class="py-3 px-6">{{ $item->icon }}</td>
                                    <td class="py-3 px-6">

                                        {{-- <a href={{route('/admin/transactions/ {{ $item->slug}}/edit')}}
                                            class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a> --}}
                                        <a href="{{ route('admin.transactions.edit', $item->slug) }}"
                                            class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <form action="{{ route('admin.transactions.destroy', $item->slug) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Anda yakin akan menghapus transaksi : {{ $item->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <input type="hidden"> --}}
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 text-sm font-semibold text-white bg-red-500 rounded-full">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
