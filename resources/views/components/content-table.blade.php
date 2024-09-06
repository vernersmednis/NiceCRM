@props(['dataAjax' => '', 'companies' => [], 'company' => '' ])
<!-- In case of 'Edit company' or 'Create company' -->
@if ($company != '')
    <table id="companies-table" class="display" data-storage="{{ asset('storage/') }}" data-ajax="{{ $dataAjax }}">
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
                    <input id="logoInput" class="w-full" type="file" name="logo"/>
                </td> 
                <!-- Company name -->
                <td class="px-4 py-2 border"><input class="w-full" type="text" name="name" value="{{ $company->name }}"/></td> 
                 <!-- Company email -->
                <td class="px-4 py-2 border"><input class="w-full" type="text" name="email" value="{{ $company->email }}"/></td>
                <!-- "Save" button -->
                <td class="px-4 py-2 border">
                    <button type="submit" class="bg-white border border-blue-500 text-blue-500 px-4 py-2 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">{{ __('Create') }}</button>
                </td>
            </tr>
        </tbody>
    </table>
<!-- In case of listing all companies -->
@else
    <table id="companies-table" class="display" data-storage="{{ asset('storage/') }}" data-ajax="{{ $dataAjax }}">
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
@endif