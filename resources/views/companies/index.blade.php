<x-app-layout>
    <!-- Slot for the page header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <!-- Main content area -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <!-- Button to create a new company -->
                        <button class="bg-green-500 text-white font-bold py-2 px-4 my-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                            {{ __('Create New Company') }}
                        </button>
                        <div class="grid grid-cols-1 gap-0">
                            <!-- Table title -->
                            <div class="col-span-1 border px-8 py-4 text-xl">
                                {{ __('Companies List') }}
                            </div>
                            <!-- Table to display the list of companies -->
                            <div class="col-span-1 border p-8">
                                <table id="companies-table" class="display" data-storage="{{ asset('storage/') }}" data-ajax="{{ route('api.companies') }}">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- Company logo -->
                                            <td class="px-4 py-2 border flex gap-4">
                                                <img id="logoImage" src="" alt="Company Logo" class="w-10 h-10 object-cover">
                                                <input id="logoInput" class="w-full" type="file" name="logo"/>
                                            </td> 
                                            <!-- Company name -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- Company email -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- "Edit" and "Delete" buttons -->
                                            <td class="px-4 py-2 border">
                                                <button data-id="${data.id}" class="delete-btn bg-orange-500 text-white px-2 py-1 rounded hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">__('Delete')</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/css/companies/index.css', 'resources/js/companies/index.js'])