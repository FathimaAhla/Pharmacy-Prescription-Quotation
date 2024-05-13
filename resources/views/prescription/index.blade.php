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
                    <div class="d-flex align-items-center flex justify-between mb-4">
                        <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">List Prescription</h1>

                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            href="{{ route('prescription.create') }}">
                            Add Prescription
                        </a>
                    </div>
                    <hr />
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Note
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delivery Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Delivery Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescriptions as $prescription)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $loop->iteration }}</td>
                                    <td class="align-middle px-6 py-4 border-t-0 border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700 flex gap-2">
                                        @foreach (json_decode($prescription->images) as $image)
                                            <img src="/images/{{ $image }}" alt="image" class="w-20 h-20">
                                        @endforeach
                                    </td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->note }}</td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->delivery_address }}</td>
                                    <td class="align-middle px-6 py-4">{{ $prescription->delivery_time }}</td>
                                    <td class="align-middle px-6 py-4">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            {{-- {/* Edit Page Link  */} --}}
                                            <a class="text-indigo-700 hover:text-blue-900 font-bold mx-4 px-2"
                                                type="button"
                                                href="{{ route('prescription.edit', $prescription->id) }}">
                                                Edit
                                            </a>

                                            {{-- {/* Book delete function  */} --}}
                                            <form action="{{ route('prescription.destroy', $prescription->id) }}"
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
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">prescriptions not found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
