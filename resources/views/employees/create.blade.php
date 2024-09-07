<x-app-layout>
    <!-- Slot for the page header -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
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
                                {{ __('Employee Settings') }}
                            </div>
                            <div class="col-span-1 border p-8">
                                <!-- 'Create employee' form -->
                                <form method="POST" action="/employees" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Table to display the employee settings -->
                                    <input type="hidden" name="company_id" value="{{ $company_id }}"/>                              
                                    <table id="employees-table" class="display" data-storage="{{ asset('storage/') }}">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <!-- Employee first name -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="first_name" value=""/></td> 
                                                <!-- Employee last name -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="last_name" value=""/></td> 
                                                <!-- Employee email -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="email" value=""/></td>
                                                <!-- Employee phone -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="phone" value=""/></td>
                                                <!-- "Save" button -->
                                                <td class="px-4 py-2 border">
                                                    <button type="submit" class="bg-white border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">{{ __('Save') }}</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Error messages -->
                                    <div class="text-red-500">
                                        @error('first_name'){{ $message }}<br>@enderror
                                        @error('last_name'){{ $message }}<br>@enderror
                                        @error('email'){{ $message }}<br>@enderror
                                        @error('phone'){{ $message }}<br>@enderror
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
@vite(['resources/css/employees/create.css', 'resources/js/employees/create.js'])
    