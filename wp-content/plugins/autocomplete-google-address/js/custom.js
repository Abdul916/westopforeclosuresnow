function autocomplet_set_google_autocomplete(){
	jQuery(input_fields).each(function(){

		let autocomplete= new google.maps.places.Autocomplete(
		/** @type {HTMLInputElement} */(this));

    autocomplete.addListener("place_changed", fillInAddress);

    function fillInAddress() {
      const place = autocomplete.getPlace();
      jQuery(input_fields).trigger("change");
    }

	});
}
jQuery(window).on('load',function () {
	autocomplet_set_google_autocomplete();
});
