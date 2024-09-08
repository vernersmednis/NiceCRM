$(function() {
    
    // Get the CSRF token for secure 'DELETE' requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Initialize DataTable with server-side processing
    var originalTableTemplateContent = $('#companies-table');
    var actions = originalTableTemplateContent.find('.actions');
    var urlTemplate = actions.find('a').attr('data-url');
    $('#companies-table').removeClass('hidden').DataTable({
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
                    // Render Details and Delete buttons for each row
                    var companyUrl = urlTemplate.replace(':company', data.id);
                    actions.find('a').attr('href', companyUrl);
                    actions.find('.delete-btn').attr('data-id', data.id);
                    return actions.html();
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

        // Send AJAX request to delete the record
        $.ajax({
            url: `/companies/${id}`, // URL to delete the specific company
            type: 'DELETE', // HTTP method for deletion
            headers: {
                'X-CSRF-TOKEN': csrfToken, // Send CSRF token for security
            },
            success: function () {
                $('#companies-table').DataTable().ajax.reload(); // Reload the table data after successful deletion
            },
            error: function (xhr, status, error) {
                console.error('Error deleting record:', error);
                alert('Failed to delete record.');
            }
        });
    });
});