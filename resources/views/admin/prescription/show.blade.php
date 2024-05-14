<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Prescription') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center flex justify-between mb-4">
                        <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">Prescription Detail</h1>

                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            href="{{ route('admin/prescriptions.index') }}">
                            Prescription List
                        </a>
                    </div>
                    <hr />
                    <div class="flex flex-wrap justify-around mt-4 gap-4">
                        <div class="w-1/2 min-w-[300px] mb-12">
                            @foreach (json_decode($prescription->images) as $key => $image)
                                @if ($key == 0)
                                    <!-- Large Image -->
                                    <img src="/images/{{ $image }}" alt="" class="" id="product-img"
                                        style="width: 600px; height: 400px;">
                                @endif
                            @endforeach
                            <div class="flex gap-2 mt-2">
                                <!-- Small Images -->
                                @foreach (json_decode($prescription->images) as $image)
                                    <div class="w-1/5 cursor-pointer">
                                        <img src="/images/{{ $image }}" alt=""
                                            class="w-20 h-20 small-img" onclick="updateLargeImage(this)">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-1/2  mb-12 ml-8 flex-1 justify-center">
                            <div class="">

                                <table id="drugDetailsTable"
                                    class="w-full text-sm text-left rtl:text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Drug
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Quantity
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Amount
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotations as $quotation)
                                            <tr class="bg-white border-b">
                                                <td class="align-middle px-6 py-4">
                                                    {{ $quotation->drug->name }}
                                                </td>
                                                <td class="align-middle px-6 py-4">
                                                    {{ $quotation->drug->price }} x {{ $quotation->quantity }}
                                                </td>
                                                <td class="align-middle px-6 py-4">
                                                    {{ $quotation->drug->price }} * {{ $quotation->quantity }}
                                                </td>
                                            </tr>
                                        @endforeach

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
                                            <td class="align-middle px-6 py-4">{{$totalPrice}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex justify-end">
                                <form action="{{ route('admin/quotations.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $prescription->id }}" name="prescription_id">
                                    <input type="hidden" value="{{ $prescription->user_id }}" name="user_id">
                                    <div class="mt-4 ">
                                        <x-input-label for="drug_id" :value="__('Drug')" />
                                        <select name="drug_id" id=""
                                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="">Select Drug</option>
                                            @foreach ($drugs as $drug)
                                                <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="quantity" :value="__('Qty')" />
                                        <x-text-input id="quantity" class="block mt-1 w-full" type="number"
                                            name="quantity" :value="old('quantity')" required autocomplete="quantity" />
                                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ms-4">
                                            {{ __('Add') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <form action="{{ route('admin/quotation-details.store') }}" method="POST">
                                    @csrf
                                    @foreach ($quotations as $quotation)
                                        <input type="hidden" name="user_id" value="{{ $quotation->user_id }}">
                                        <input type="hidden" name="prescription_id"
                                            value="{{ $quotation->prescription_id }}">
                                        <input type="hidden" name="qutation_id" value="{{ $quotation->id }}">
                                        <input type="hidden" name="total" value="{{ $quotation->total_price }}">
                                    @endforeach
                                    <x-primary-button class="ms-4">
                                        {{ __('Send Quotation') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateLargeImage(image) {
            // Get the source of the clicked small image
            var newSrc = image.src;

            // Update the source of the large image
            document.getElementById('product-img').src = newSrc;
        }
    </script>
</x-app-layout>
