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
                            <!-- Table to display the company settings -->
                            <div class="col-span-1 border p-8">
                                <form method="POST" action="/companies" enctype="multipart/form-data">
                                    @csrf
                                    <table class="min-w-max w-full bg-white border border-gray-300">
                                        <thead>
                                            <tr>
                                                <!-- Table headers -->
                                                <th class="px-4 py-2 border">{{ __('Logo') }}</th>
                                                <th class="px-4 py-2 border">{{ __('Name') }}</th>
                                                <th class="px-4 py-2 border">{{ __('Email') }}</th>
                                                <th class="px-4 py-2 border"></th> <!-- Empty header for action buttons -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="px-4 py-2 border flex gap-4">
                                                    <img id="logoImage" src="" alt="Company Logo" class="w-10 h-10 object-cover">
                                                    <input id="logoInput" class="w-full" type="file" name="logo"/>
                                                </td> <!-- Company logo -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="name" value=""/></td> <!-- Company name -->
                                                <td class="px-4 py-2 border"><input class="w-full" type="text" name="email" value=""/></td> <!-- Company email -->
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
@vite('resources/js/companies/edit.js')
