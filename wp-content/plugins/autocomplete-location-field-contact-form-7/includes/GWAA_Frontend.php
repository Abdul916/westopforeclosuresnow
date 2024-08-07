<?php

/**
 * This class is loaded on the front-end since its main job is 
 * to display the WhatsApp box.
 */

class GWAA_Frontend {
	
	public function __construct () {
		add_action( 'wp_enqueue_scripts',  array( $this, 'gwaa_insta_scritps' ) );

		add_action( 'wp_footer', array($this,'GWAA_cf7_gpa_plugin_script'), 21, 1 );
	}
	public function gwaa_insta_scritps () {
		wp_enqueue_style('gwaa-stylee', GWAA_PLUGIN_URL . '/assents/css/style.css', array(), '1.0.0', 'all');

	}
	public function GWAA_cf7_gpa_plugin_script() 
	{
		$gpa_page = get_option( 'gwaa_cf7_geo_gpa_page' );
		$gwaa_country_code = get_option( 'gwaa_country_code','' );
		$gwaa_place_types = get_option( 'gwaa_place_types','' );
		
	?>
<script>
window.onload = function initialize_gpa() {
	

	var optionsc = {
		<?php
		if($gwaa_country_code!=''){
		  	echo "componentRestrictions: {country: ".json_encode(explode(",",$gwaa_country_code))."},";
		  }

		?>
		<?php
		if($gwaa_place_types!=''){
		  	echo "types: ".json_encode(explode(",",$gwaa_place_types)).",";

		  }
		?>
	};
    var acInputs = document.getElementsByClassName("wpcf7-gmautocomplete");
	for (var i = 0; i < acInputs.length; i++) {
		ApplyAutoComplete(acInputs[i],optionsc)
	}

}
function ApplyAutoComplete(input,optionsc) {
		var autocomplete = new google.maps.places.Autocomplete(input,optionsc);
		autocomplete.inputId = input.id;
		autocomplete.inputName = input.name;
		
		var address2Field = document.querySelector("#"+autocomplete.inputName+"_address2");
		var postalField = document.querySelector("#"+autocomplete.inputName+"_postcode");
		
		
		google.maps.event.addListener(autocomplete, 'place_changed', function () {
			
			const place = autocomplete.getPlace();
			console.log(place);
			let address1 = "";
			let postcode = "";
			console.log(autocomplete.inputName);
			if(document.getElementById(autocomplete.inputName+"map")){
				document.getElementById(autocomplete.inputName+"map").style.display = "block";
				const myLatLng = { lat: -25.363, lng: 131.044 };
				const map = new google.maps.Map(document.getElementById(autocomplete.inputName+"map"), {
					zoom: 4,
					center: myLatLng,
					mapTypeControl: false,
				});
				const marker = new google.maps.Marker({
					position: myLatLng,
					map,
				});
				marker.setVisible(false);
				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(17);
				}
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);
			}
			
			for (const component of place.address_components) {
			    const componentType = component.types[0];

			    switch (componentType) {
			      case "street_number": {
			        address1 = `${component.long_name} ${address1}`;
			        break;
			      }

			      case "route": {
			        address1 += component.short_name;
			        break;
			      }

			      case "postal_code": {
			        postcode = `${component.long_name}${postcode}`;
			        break;
			      }

			      case "postal_code_suffix": {
			        postcode = `${postcode}-${component.long_name}`;
			        break;
			      }
			      case "locality":
			      	if(document.getElementById(autocomplete.inputName+"_locality")){
			      		document.querySelector("#"+autocomplete.inputName+"_locality").value = component.long_name;
			      	}
			        
			        break;
			      case "administrative_area_level_1": {
			      	if(document.getElementById(autocomplete.inputName+"_state")){
				        document.querySelector("#"+autocomplete.inputName+"_state").value = component.short_name;
				    }
			        break;
			      }
			      case "country":
			      	if(document.getElementById(autocomplete.inputName+"_country")){
			        	document.querySelector("#"+autocomplete.inputName+"_country").value = component.long_name;
			    	}
			        break;
			    }
			}
			if(document.getElementById(autocomplete.inputName+"_address2")){
				address2Field.value = address1;
			}
			console.log(autocomplete.inputName);
			if(document.getElementById(autocomplete.inputName+"_postcode")){
				postalField.value = postcode;
			}
		});
}
</script>
	<?php 
				
	}
}