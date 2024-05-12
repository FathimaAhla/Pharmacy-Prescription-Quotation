<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drug') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center flex justify-between mb-4">
                        <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">List Drug</h1>

                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            href="{{ route('admin/drugs.create') }}">
                            Add Drug
                        </a>
                    </div>
                    <hr />
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Drug name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($drugs as $drug)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}</td>
                                    <td class="align-middle px-6 py-4">{{ $drug->name }}</td>
                                    <td class="align-middle px-6 py-4">{{ $drug->price }}</td>
                                    <td class="align-middle px-6 py-4">{{ $drug->description }}</td>
                                    <td class="align-middle px-6 py-4">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            {{-- {/* Edit Page Link  */} --}}
                                            <a class="text-indigo-700 hover:text-blue-900 font-bold mx-4 px-2"
                                                type="button" href="{{ route('admin/drugs.edit', $drug->id) }}">
                                                Edit
                                            </a>

                                            {{-- {/* Book delete function  */} --}}
                                            <form action="{{ route('admin/drugs.destroy', $drug->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-700 hover:text-red-900 font-bold mx-2 px-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Drugs not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
