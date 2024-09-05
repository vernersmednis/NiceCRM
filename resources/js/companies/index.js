$(function() {
    // Attach event listener to the delete buttons in the table
    $('.delete-btn').on('click', function() {
        let companyId = $(this).parent().parent().data('id');
        let row = $('#company-row-' + companyId);
        let token = row.data('token');  // Get the CSRF token from the table row

        if (confirm('Are you sure you want to delete this company?')) {
            $.ajax({
                url: '/companies/' + companyId,
                type: 'DELETE',
                data: {
                    "_token": token  // Send the token from the tablerow
                },
                success: function(response) {
                    // Remove the row from the table
                    row.remove();
                },
                error: function(response) {
                    // Display error if failed
                    alert('Failed to delete the company. Try again.');
                }
            });
        }
    });
});
