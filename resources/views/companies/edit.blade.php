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
                                {{ __('Company Settings') }}
                            </div>
                            <!-- Table to display the list of companies -->
                            <div class="col-span-1 border p-8">
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
                                            <td class="px-4 py-2 border"><input class="w-full" type="text" value="{{ $company->logo }}"/></td> <!-- Display company logo -->
                                            <td class="px-4 py-2 border"><input class="w-full" type="text" value="{{ $company->name }}"/></td> <!-- Display company name -->
                                            <td class="px-4 py-2 border"><input class="w-full" type="text" value="{{ $company->email }}"/></td> <!-- Display company email -->
                                            <!-- "Save" button -->
                                            <td class="px-4 py-2 border">
                                                <button class="bg-white border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">{{ __('Save') }}</button>
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
