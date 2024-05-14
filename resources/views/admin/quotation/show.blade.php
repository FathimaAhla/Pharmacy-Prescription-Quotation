<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center flex justify-between mb-4">
                        <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">List Quotation</h1>

                    </div>
                    <hr />
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    User Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Drug Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quotations as $quotation)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->user_id }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->drug_id }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->quantity }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->price }}</td>
                                    <td class="align-middle px-6 py-4">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            {{-- {/* Edit Page Link  */} --}}
                                            <a class="text-indigo-700 hover:text-blue-900 font-bold mx-4 px-2"
                                                type="button" href="{{ route('admin/quotations.edit', $quotation->id) }}">
                                                Edit
                                            </a>

                                            {{-- {/* Book delete function  */} --}}
                                            <form action="{{ route('admin/quotations.destroy', $quotation->id) }}" method="POST">
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
                                    <td class="text-center" colspan="5">Quotations not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
