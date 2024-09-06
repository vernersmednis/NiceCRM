$(function() {
    // Get the CSRF token for secure 'DELETE' requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Initialize DataTable with server-side processing
    $('#companies-table').DataTable({
        processing: true, // Show a processing indicator when the table is loading
        serverSide: true, // Enable server-side processing to fetch data from the server
        ajax: {
            url: $('#companies-table').data('ajax'), // Dynamic URL for data fetching
            method: 'GET', // HTTP method to fetch the data
            dataSrc: function (json) {
                return json.data; // Extract data for the table from the server response
            }
        },
        columns: [
            {
                data: 'logo',
                render: function (data) {
                    // Render the logo image in each row
                    return '<img src="' + $('#companies-table').data('storage') + '/' + data + '" alt="Logo" class="inline-flex w-10 h-10">';
                }
            },
            { data: 'name' }, // Display the company name
            { data: 'email' }, // Display the company email
            {
                data: null,
                render: function (data) {
                    // Render Edit and Delete buttons for each row
                    return `
                        <button class="bg-white border border-blue-500 text-blue-500 px-2 py-1 rounded hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">__('Edit')</button>
                        <button data-id="${data.id}" class="delete-btn bg-orange-500 text-white px-2 py-1 rounded hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">__('Delete')</button>
                    `;
                }
            }
        ],
        pageLength: 10, // Set the number of rows displayed per page
        lengthChange: false, // Disable the ability to change the number of rows displayed
        searching: false, // Disable the search/filtering functionality
        responsive: true, // Enable responsive behavior for better mobile view
        columnDefs: [
            { orderable: false, targets: '_all' } // Disable sorting on all columns
        ]
    });

    // Handle Delete button click
    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id'); // Get the ID of the selected company

        if (confirm('Are you sure you want to delete this record?')) {
            // Send AJAX request to delete the record
            $.ajax({
                url: `/companies/${id}`, // URL to delete the specific company
                type: 'DELETE', // HTTP method for deletion
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Send CSRF token for security
                },
                success: function () {
                    $('#companies-table').DataTable().ajax.reload(); // Reload the table data after successful deletion
                    alert('Record deleted successfully.');
                },
                error: function (xhr, status, error) {
                    console.error('Error deleting record:', error);
                    alert('Failed to delete record.');
                }
            });
        }
    });
});