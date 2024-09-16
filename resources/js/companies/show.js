$(function() {
    
    // Initialize current company DataTable for the company details
    $('#companies-table').removeClass('hidden').DataTable({
        pageLength: 1, 
        lengthChange: false, 
        searching: false, 
        responsive: true, 
        paging: false,
        language: {
            info: "" 
        },
        ordering: false // Disable ordering via column ascending or descending

    });

    // Initialize Employees DataTable with server-side processing
    var originalTableTemplateContent = $('#employees-table');
    var actions = originalTableTemplateContent.find('.actions');
    var formActionUrlTemplate = originalTableTemplateContent.find('form').attr('action');
    var urlTemplate = actions.find('a').attr('data-url');
    $('#employees-table').removeClass('hidden').DataTable({
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
                    var companyUrl = urlTemplate.replace(':employee', data.id);
                    actions.find('a').attr('href', companyUrl);
                    actions.find('.delete-btn').attr('data-id', data.id);
                    var formActionUrl = formActionUrlTemplate.replace(':employee', data.id);
                    actions.find('form').attr('action', formActionUrl);
                    return actions.html();
                }
            }
        ],
        pageLength: 10, // Set the number of rows displayed per page
        lengthChange: false, // Disable the ability to change the number of rows displayed
        searching: false, // Disable the search/filtering functionality
        responsive: true, // Enable responsive behavior for better mobile view
        ordering: false // Disable ordering via column ascending or descending

    });
});