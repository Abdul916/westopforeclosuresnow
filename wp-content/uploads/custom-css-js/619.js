<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
/* Default comment here */ 

jQuery(document).ready(function( $ ){
        var autocomplete = new google.maps.places.Autocomplete(jQuery("#autocomplete")[0], {});

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            console.log(place.address_components);
        });
    });
</script>
<!-- end Simple Custom CSS and JS -->
