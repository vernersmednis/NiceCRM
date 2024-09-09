$(function() {

    // Initialize DataTable for the 'Edit employee' page
    $('#employees-table').DataTable({
        pageLength: 1, 
        lengthChange: false, 
        searching: false, 
        responsive: true, 
        paging: false,
        language: {
            info: "" // Remove "Showing 1 to 1 of 1 entry" text
        },
        columnDefs: [
            { orderable: false, targets: '_all' } // Disable sorting for all columns
        ]
    });
});
