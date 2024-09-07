<x-app-layout>
    <!-- Slot for the page header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Company') }}
        </h2>
    </x-slot>

    <!-- Main content area -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <div class="grid grid-cols-1 gap-0">
                            <!-- Table title -->
                            <div class="col-span-1 border px-8 py-4 text-xl">
                                {{ __('Company Settings') }}
                            </div>
                            <div class="col-span-1 border p-8">
                                <!-- 'Create company' form -->
                                <form method="POST" action="/companies" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Table to display the company settings -->                              
                                    <table id="companies-table" class="display" data-storage="{{ asset('storage/') }}">
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
                                                    <img id="logoImage" src="{{ asset('storage/') }}" alt="Company Logo" class="w-10 h-10 object-cover">
                                                    <label id="customLogoInput">
                                                        <input id="logoInput" type="file" name="logo">
                                                        <span >Choose file</span>
                                                    </label>
                                                </td> 
                                                <!-- Company name -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="name" value=""/></td> 
                                                <!-- Company email -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="email" value=""/></td>
                                                <!-- "Save" button -->
                                                <td class="px-4 py-2 border">
                                                    <button type="submit" class="bg-white border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">{{ __('Create') }}</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Error messages -->
                                    <div class="text-red-500">
                                        @error('logo'){{ $message }}<br>@enderror
                                        @error('name'){{ $message }}<br>@enderror
                                        @error('email'){{ $message }}<br>@enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@vite(['resources/css/companies/create.css', 'resources/js/companies/create.js'])
    