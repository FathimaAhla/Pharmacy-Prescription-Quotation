<x-app-layout>
    <x-slot name="header" class="flex justify-between">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Update Prescription') }}
            </h2>
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                href="{{ route('prescription.index') }}">
                {{ __('Prescription List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">Add Prescription</h1>
                    <hr />

                    <form action="{{ route('prescription.update'), $prescription->id)  }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <x-text-input id="user_id" class="block mt-1 w-full" type="hidden" name="user_id"
                        :value="old('user_id', auth()->user()->id)" required autofocus autocomplete="user_id" />

                        <!-- Image -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="images" :value="__('Prescription')" />
                                <x-text-input id="images" class="block mt-1 w-full" type="file" name="images[]"
                                    :value="old('images')" required autofocus autocomplete="" multiple />
                                <x-input-error :messages="$errors->get('images')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Delivery Address -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="delivery_address" :value="__('Delivery Address')" />
                                <x-text-input id="delivery_address" class="block mt-1 w-full" type="text" name="delivery_address"
                                    :value="old('delivery_address', $prescription->delivery_address)" required autofocus autocomplete="delivery_address" />
                                <x-input-error :messages="$errors->get('delivery_address')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Delivery Time -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="delivery_time" :value="__('Delivery Time')" />

                                <x-text-input id="delivery_time" class="block mt-1 w-full" type="text"
                                    name="delivery_time" :value="old('delivery_time', $prescription->delivery_time)" required autofocus
                                    autocomplete="delivery_time" />

                                <x-input-error :messages="$errors->get('delivery_time')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Note -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="note" :value="__('Note')" />
                                <x-text-input id="note" class="block mt-1 w-full" type="text"
                                    name="note" :value="old('note', $prescription->note)" required autofocus
                                    autocomplete="note" />
                                <x-input-error :messages="$errors->get('note')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                href="{{ route('prescription.index') }}">
                                {{ __('Go Back') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
