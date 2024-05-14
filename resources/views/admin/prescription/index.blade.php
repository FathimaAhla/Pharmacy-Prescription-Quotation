<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prescription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <hr />
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    User Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delivery Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delivery Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescriptions as $prescription)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        00{{ $loop->iteration }}</td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->user->name }}</td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->delivery_address }}</td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->delivery_time }}</td>
                                    <td class="align-middle px-6 py-4">
                                        <span type="button"
                                            class="btn {{ $prescription->status == 'pending' ? 'btn-success' : 'btn-danger' }} btn-xs py-0">{{ $prescription->status == 'complete' ? 'Complete' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="align-middle px-6 py-4">

                                        {{-- {/* Create Quotation Page Link  */} --}}
                                        <a class="text-indigo-700 hover:text-blue-900 font-bold mx-4 px-2"
                                            type="button"  href="{{ route('admin/prescriptions.show', $prescription->id) }}">
                                            Update Medications
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">prescriptions not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="mt-6">
                        {{ $prescriptions->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
