<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 

jQuery(document).ready(function($) {
    $('form.wpcf7-form').on('submit', function(e) {
        // Prevent the form from submitting
        e.preventDefault();

        // Check if all form fields are filled
        var allFieldsFilled = true;
        $(this).find('.wpcf7-form-control').each(function() {
            if ($(this).val() === '') {
                allFieldsFilled = false;
                return false; // Exit the loop if any field is empty
            }
        });

        // If all fields are filled, display the message
        if (allFieldsFilled) {
            // Customize the message here
            var message = 'Submitting your info please wait…….';
            
            // Append the message after the submit button
            $('<div class="wpcf7-success-message">' + message + '</div>').insertAfter($(this).find('.wpcf7-submit'));
            
        }
    });
});
</script>
<!-- end Simple Custom CSS and JS -->
