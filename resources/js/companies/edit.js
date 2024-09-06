$(function() {

    // Initialize DataTable for the 'Edit company' page
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

    // Functionality to display the selected company logo when "Choose File" is clicked
    $(document).on('change', '#logoInput', function(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logoImage').attr('src', e.target.result); // Update logo image with the selected file
            };
            reader.readAsDataURL(file); // Convert file to data URL for image display
        }
    });
});
