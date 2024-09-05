$(function() {
    // Funcionality for displaying the company logo 
    // (when clicking "Choose File")
    $('#logoInput').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#logoImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
