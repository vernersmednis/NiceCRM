$(function() {

    // Initialize DataTable for the 'Create company' page
    $('#companies-table').DataTable({
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

    
    // Functionality to display the selected company logo when "Choose File" is clicked
    // Cleaner display of the logo "file input"
    $(document).on('change', '#logoInput', function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            $('#customLogoInput span').text(file.name);
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logoImage').attr('src', e.target.result); // Update logo image with the selected file
            };
            reader.readAsDataURL(file); // Convert file to data URL for image display
        }
    });

});
