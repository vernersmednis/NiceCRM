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
                            <div class="col-span-1 border p-8">
                                <!-- 'Edit company' form -->
                                <form method="POST" action="/companies/{{$company->id}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <!-- Table to display the company settings -->
                                    <x-content-table :company="$company"/>
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
