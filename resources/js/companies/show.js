$(function() {
    
    // Get the CSRF token for secure 'DELETE' requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Initialize DataTable for the company details
    $('#companies-table').DataTable({
        pageLength: 1, 
        lengthChange: false, 
        searching: false, 
        responsive: true, 
        paging: false,
        language: {
            info: "" 
        },
        columnDefs: [
            { orderable: false, targets: '_all' } 
        ]
    });

    // Initialize DataTable with server-side processing
    $('#employees-table').DataTable({
        processing: true, // Show a processing indicator when the table is loading
        serverSide: true, // Enable server-side processing to fetch data from the server
        ajax: {
            url: $('#employees-table').data('ajax'), // Dynamic URL for data fetching
            method: 'GET', // HTTP method to fetch the data
            dataSrc: function (json) {
                return json.data; // Extract data for the table from the server response
            }
        },
        columns: [
            { data: 'first_name' },
            { data: 'last_name' }, // Display the employee name
            { data: 'email' }, // Display the employee email
            { data: 'phone' },
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
        const id = $(this).data('id'); // Get the ID of the selected employee

        // Send AJAX request to delete the record
        $.ajax({
            url: `/employee/${id}`, // URL to delete the specific employee
            type: 'DELETE', // HTTP method for deletion
            headers: {
                'X-CSRF-TOKEN': csrfToken, // Send CSRF token for security
            },
            success: function () {
                $('#employee-table').DataTable().ajax.reload(); // Reload the table data after successful deletion
            },
            error: function (xhr, status, error) {
                console.error('Error deleting record:', error);
                alert('Failed to delete record.');
            }
        });
    });
});