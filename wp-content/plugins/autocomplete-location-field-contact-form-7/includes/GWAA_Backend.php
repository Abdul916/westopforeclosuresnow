<?php
/**
* This class is loaded on the front-end since its main job is
* to display the WhatsApp box.
*/
class GWAA_Backend {
	
	public function __construct () {
		add_action('admin_menu', array($this,'GWAA_cf7_address_autocomplete_menu_item'));
		add_action('admin_init', array($this,'GWAA_cf7_address_autocomplete_display_gpa_fields'));
		add_action( 'wp_enqueue_scripts', array($this,'GWAA_cf7_gpa_load_user_api' ));
	}
	public function GWAA_cf7_address_autocomplete_menu_item()
	{
		add_submenu_page(
											'wpcf7',
											__('Google Place API','google-place-api'),
											__('Google Place API','google-place-api'), 
											'manage_options',
											'google-place-api',
											array($this, 'GWAA_cf7_google_place_admin' ),
										);
	}
	public function GWAA_cf7_google_place_admin()
	{
		$gwaa_country_code = get_option('gwaa_country_code','');
		$gwaa_address_option = get_option('gwaa_address_option',array());
		if(empty($gwaa_address_option)){
        	$gwaa_address_option = array();
        }
        $gwaa_place_types = get_option('gwaa_place_types','');
        $gwaa_enable_map = get_option('gwaa_enable_map','');
        
?>
		<div class="wrap">
			<h1>Google Places API Info.</h1>
			<div class="about-text">
		        <p>
					Thank you for using our plugin! If you are satisfied, please reward it a full five-star <span style="color:#ffb900">★★★★★</span> rating.                        <br>
		            <a href="https://wordpress.org/support/plugin/autocomplete-location-field-contact-form-7/reviews/?filter=5" target="_blank">Reviews</a>
		            | <a href="https://www.codesmade.com/contact-us/" target="_blank">Support</a>
		        </p>
		    </div>
			
			<form method="post" action="options.php">
				<?php settings_fields( 'gwaa_section' ); ?>
				<table class="form-table" role="presentation">
				   <tbody>
				      <tr>
				         <th scope="row">Google Places API Key</th>
				         <td>
				            <input type="text" class="regular-text" required="" name="gwaa_cf7_geo_api_key" id="api_key" value="<?php echo esc_attr(get_option('gwaa_cf7_geo_api_key'));?>">
				            <p class="description">Google requires an API key to retrieve Auto Complete Address for job listings. Acquire an API key from the <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/places-autocomplete">Google Maps API developer site</a>.</p>
				         </td>
				      </tr>
				      <tr valign="top">
			            <th scope="row">
			               <label>Specific Country Address Show</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" placeholder="US,AU" name="gwaa_country_code" value="<?php echo $gwaa_country_code; ?>" readonly /> <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			               <p class="description"><strong>Default is blank</strong> it will be show all Country address if you want to particular country address than add two digit code <strong>Example: France for add fr</strong> <a href="https://codesmade.com/demo/country-code-list/">Get Country Code list</a></p>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Enable Map</label>
			            </th>
			            <td>
			            	 <input  type="checkbox"  name="gwaa_enable_map" value="true" <?php echo ($gwaa_enable_map=="true")?'checked':''?> disabled />Show Map on selected address <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Enable Address Field Option</label>
			            </th>
			            <td>
			            	 <input  type="checkbox"  name="gwaa_address_option[]" value="street_number" <?php echo (in_array("street_number", $gwaa_address_option))?'checked':''?> disabled />Street Number<br/>
			            	 <input  type="checkbox"  name="gwaa_address_option[]" value="postcode" <?php echo (in_array("postcode", $gwaa_address_option))?'checked':''?>  disabled />Postcode<br/>
			            	 <input  type="checkbox"  name="gwaa_address_option[]" value="locality" <?php echo (in_array("locality", $gwaa_address_option))?'checked':''?>  disabled />Locality<br/>
			            	 <input  type="checkbox"  name="gwaa_address_option[]" value="administrative_area_level_1" <?php echo (in_array("administrative_area_level_1", $gwaa_address_option))?'checked':''?> disabled />State<br/>
			            	 <input  type="checkbox"  name="gwaa_address_option[]" value="country" <?php echo (in_array("country", $gwaa_address_option))?'checked':''?> disabled />Country<br/><a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			          <tr valign="top">
			            <th scope="row">
			               <label>Place Types</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" placeholder="airport,art_gallery" name="gwaa_place_types" value="<?php echo $gwaa_place_types; ?>"  readonly /><a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			               <p class="description"><strong>Default is blank</strong> You can setup place type there. example if you want art gallery than you need to add there <strong>art_gallery</strong>.<a href="https://developers.google.com/maps/documentation/places/web-service/supported_type">Get Place Type</a></p>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row" colspan="2">
			               <h3>Transalation</h3>
			            </th>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Enter a location</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_enter_loc" value="<?php echo get_option('gwaa_tr_enter_loc','Enter a location'); ?>" readonly  />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Apartment, unit, suite, or floor #</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_apartment" value="<?php echo get_option('gwaa_tr_apartment','Apartment, unit, suite, or floor #'); ?>" readonly  />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>City</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_city" value="<?php echo get_option('gwaa_tr_city','City'); ?>" readonly />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>State/Province</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_state" value="<?php echo get_option('gwaa_tr_state','State/Province'); ?>" readonly />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Postal code</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_postalcode" value="<?php echo get_option('gwaa_tr_postalcode','Postal code'); ?>" readonly />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
			         <tr valign="top">
			            <th scope="row">
			               <label>Country/Region</label>
			            </th>
			            <td>
			               <input class="regular-text" type="text" name="gwaa_tr_country" value="<?php echo get_option('gwaa_tr_country','Country/Region'); ?>" readonly />
			               <a href="https://www.codesmade.com/store/autocomplete-location-field-contact-form-7-pro/" target="_blank">Get Pro</a>
			            </td>
			         </tr>
				   </tbody>
				</table>
				<?php
					     
					submit_button(); 
				?>
			
			</form>
		</div>
<?php
	}
	
	public function GWAA_cf7_address_autocomplete_display_gpa_fields()
	{
		
			
			register_setting('gwaa_section', 'gwaa_cf7_geo_api_key', array($this,'GWAA_sanitize_setting'));
			register_setting('gwaa_section', 'gwaa_country_code');
			register_setting('gwaa_section', 'gwaa_address_option');
			register_setting('gwaa_section', 'gwaa_place_types');
			register_setting('gwaa_section', 'gwaa_enable_map');


			register_setting('gwaa_section', 'gwaa_tr_enter_loc');
			register_setting('gwaa_section', 'gwaa_tr_apartment');
			register_setting('gwaa_section', 'gwaa_tr_city');
			register_setting('gwaa_section', 'gwaa_tr_state');
			register_setting('gwaa_section', 'gwaa_tr_postalcode');
			register_setting('gwaa_section', 'gwaa_tr_country');
	  
	}
	public function GWAA_sanitize_setting($value) {
	    // Sanitize the setting value here
	    return sanitize_text_field($value);
	}
	public function GWAA_cf7_gpa_load_user_api()
	{
	  $api_script ='';
	  $gpa_page = get_option( 'gwaa_cf7_geo_gpa_page' );
	  $api_key = get_option( 'gwaa_cf7_geo_api_key' );
	  if(is_ssl())
	  {
			$securee = 'https';
	  }
	  else
	  {
			$securee = 'http';
	  }
	  $api_script .= $securee.'://maps.googleapis.com/maps/api/js?key=' . $api_key . '&libraries=places';
	 //$api_script ='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places';
		  wp_enqueue_script( 'gpa-google-places-api', $api_script, array(), 'null', true );
		
	}
	
	
}
?>