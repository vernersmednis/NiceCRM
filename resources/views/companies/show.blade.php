<x-app-layout>
    <!-- Slot for the page header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}
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
                                {{ __('Company Details') }}
                            </div>
                            <div class="col-span-1 border p-8">
                                <!-- Table to display the company information -->
                                <table id="companies-table" class="display" data-storage="{{ asset('storage/') }}" data-ajax="">
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
                                                <img id="logoImage" src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" class="w-10 h-10 object-cover">
                                            </td> 
                                            <!-- Company name -->
                                            <td class="px-4 py-2 border">{{ $company->name }}</td> 
                                            <!-- Company email -->
                                            <td class="px-4 py-2 border">"{{ $company->email }}</td>
                                            <!-- "Edit" button -->
                                            <td class="px-4 py-2 border">
                                                <button class="bg-white border border-blue-500 text-blue-500 px-2 py-1 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">__('Edit')</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="grid grid-cols-1 gap-0">
                            <!-- Table title -->
                            <div class="col-span-1 border px-8 py-4 text-xl">
                                {{ __('Employees List') }}
                                <!-- Button to create a new employee -->
                                <button class="bg-green-500 text-white font-bold py-2 px-4 my-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                    {{ __('Create New Employee') }}
                                </button>
                            </div>
                            <!-- Table to display the list of employees -->
                            <div class="col-span-1 border p-8">
                                <table id="employees-table" class="display" data-storage="{{ asset('storage/') }}" data-ajax="{{ route('api.companies.employees', ['company' => $company->id]) }}">
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- Employee first name -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- Employee last name -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- Employee email -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- Employee phone -->
                                            <td class="px-4 py-2 border"></td> 
                                            <!-- "Edit" and "Delete" buttons -->
                                            <td class="px-4 py-2 border">
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
        </div>
    </div>
</x-app-layout>
@vite('resources/js/companies/show.js')
