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
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Drug Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Sub Total
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
                                    <td class="align-middle px-6 py-4">{{ $quotation->drug->name }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->drug->price }} *
                                        {{ $quotation->quantity }}</td>
                                    <td class="align-middle px-6 py-4">{{ $quotation->total_price }}</td>
                                    <td class="align-middle px-6 py-4">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            {{-- {/* Book delete function  */} --}}
                                            <form action="{{ route('admin/quotations.destroy', $quotation->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-700 hover:text-red-900 font-bold mx-2 px-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Add this code at the top of your Blade file -->
                                @php
                                    $totalPrice = 0;
                                    foreach ($quotations as $quotation) {
                                        // Check if the current quotation belongs to the desired prescription ID
                                        if ($quotation->prescription_id == $prescription->id) {
                                            // Add the total price of the current quotation to the total price
                                            $totalPrice += $quotation->total_price;
                                        }
                                    }
                                @endphp

                                <tr class="bg-white border-b">
                                    <td class="align-middle px-6 py-4">Total:</td>
                                    <td class="align-middle px-6 py-4"></td>
                                    <td class="align-middle px-6 py-4">{{ $totalPrice }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Quotations not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="flex justify-end">
                        <form action="{{ route('quotation.update', $quotation->id) }}" method="POST">

                            @csrf
                            @method('PUT')
                            <div class="mt-4 ">
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id=""
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Accept / Reject</option>
                                    <option value="accept">Accept </option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ms-4">
                                    {{ __('Update Status') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
