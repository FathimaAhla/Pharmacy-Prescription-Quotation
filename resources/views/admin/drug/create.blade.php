<x-app-layout>
    <x-slot name="header" class="flex justify-between">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Drug') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center flex justify-between mb-4">
                        <h1 class="mb-0 font-semibold text-xl text-gray-800 leading-tight">Add a new Drug</h1>

                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            href="{{ route('admin/drugs.index') }}">
                            Drug List
                        </a>
                    </div>
                    <hr />
                    <hr />

                    <form action="{{ route('admin/drugs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->

                        <div class="row mb-3 mt-4">
                            <div class="col">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Price -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                    :value="old('price')" required autofocus autocomplete="price" />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Description -->

                        <div class="row mb-3">
                            <div class="col">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-area id="description" class="block mt-1 w-full"
                                    name="description" :value="old('description')" required autofocus
                                    autocomplete="description" />
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                href="{{ route('admin/drugs.index') }}">
                                {{ __('Go Back') }}
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
