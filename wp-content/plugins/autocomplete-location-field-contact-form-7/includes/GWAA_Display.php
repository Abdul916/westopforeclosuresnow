<?php
/**
* This class is loaded on the front-end since its main job is
* to display the WhatsApp box.
*/
class GWAA_Display {
	
	public function __construct () {
		add_action('wpcf7_init', array($this, 'GWAA_cf7_autocomplete_add_tag_generator'));
		add_action( 'admin_init', array($this, 'GWAA_add_products_tag_generator_menu'));
		add_action( 'wpcf7_validate_products', array($this, 'GWAA_products_validation_filter'));
	}
	
	public function GWAA_cf7_autocomplete_add_tag_generator()
	{
		
		wpcf7_add_form_tag( array( 'gmautocomplete', 'gmautocomplete*' ),array($this, 'GWAA_wpcf7_cfpl_products_shortcode_handler'),true);
		
		
		
	}
	public function GWAA_wpcf7_cfpl_products_shortcode_handler( $tag )
	{
		
		if (empty($tag->name)) 
		{
			return '';
		}
		
		$validation_error = wpcf7_get_validation_error( $tag->name );
		$class = wpcf7_form_controls_class( $tag->type, 'gmautocomplete' );
		
		/* $class = wpcf7_form_controls_class( $tag->type ); */

		if ( $validation_error ) 
		{
			$class .= ' wpcf7-not-valid';
		}
		
		$atts = array();
		$atts['size']		= $tag->get_size_option( '40' );
		$atts['maxlength']	= $tag->get_maxlength_option();
		$atts['class']		= $tag->get_class_option( $class );
		$atts['id']			= $tag->get_id_option();
		$atts['tabindex']	= $tag->get_option( 'tabindex', 'int', true );

		if ( $tag->has_option( 'readonly' ) ) 
		{
			$atts['readonly'] = 'readonly';
		}

		if ( $tag->is_required() ) 
		{
			$atts['aria-required'] = 'true';
		}
		$atts['aria-invalid'] = $validation_error ? 'true' : 'false';
		
		
		
		$atts['placeholder'] = get_option('gwaa_tr_enter_loc')!=''?get_option('gwaa_tr_enter_loc'):'Enter a location';		
		$atts['type']	= 'text';
		$atts['name']	= $tag->name;
		$atts = wpcf7_format_atts($atts);
        $this->fields[$tag->name]   = $tag->values;
        $this->names[]  = $tag->name;   
        $gwaa_address_option = get_option('gwaa_address_option',array());
        if(empty($gwaa_address_option)){
        	$gwaa_address_option = array();
        }
        $gwaa_enable_map = get_option('gwaa_enable_map','');
        ob_start();
        ?>
      
        <div class="wpcf7-form-control-wrap <?php echo sanitize_html_class( $tag->name )?>">
        	<input <?php echo $atts;?> />
        	<?php echo $validation_error;?>
        	<?php
        	if (in_array("street_number", $gwaa_address_option)) {
        	?>
        	 <div class="full-field">
		        <label>
		        	<?php echo get_option('gwaa_tr_apartment')!=''?get_option('gwaa_tr_apartment'):'Apartment, unit, suite, or floor #';?>
		        </label>
		        <input id="<?php echo $tag->name;?>_address2" name="<?php echo $tag->name;?>_address2" />
		     </div>
		    <?php 
		 	}
		    ?>
		    <?php
        	if (in_array("locality", $gwaa_address_option)) {
        	?>
		     <div class="full-field">
		        <label>
		        	<?php echo get_option('gwaa_tr_city')!=''?get_option('gwaa_tr_city'):'City';?>
		        </label>
		        <input id="<?php echo $tag->name;?>_locality" name="<?php echo $tag->name;?>_locality"  />
		     </div>
		    <?php 
		 	}
		    ?>
		    <?php
        	if (in_array("administrative_area_level_1", $gwaa_address_option)) {
        	?>
		     <div class="slim-field-left">
		        <label  class="form-label">
		        	<?php echo get_option('gwaa_tr_state')!=''?get_option('gwaa_tr_state'):'State/Province';?>
		        </label>
		        <input id="<?php echo $tag->name;?>_state" name="<?php echo $tag->name;?>_state"  />
		     </div>
		    <?php 
		 	}
		    ?>
		    <?php
        	if (in_array("postcode", $gwaa_address_option)) {
        	?>
		     <div class="slim-field-right" >
		        <label >
			        <?php echo get_option('gwaa_tr_postalcode')!=''?get_option('gwaa_tr_postalcode'):'Postal code';?>
			    </label>
		        <input id="<?php echo $tag->name;?>_postcode" name="<?php echo $tag->name;?>_postcode"  />
		     </div>
		    <?php 
		 	}
		    ?>
		    <?php
        	if (in_array("country", $gwaa_address_option)) {
        	?>
		     <div class="full-field">
		        <label>
		        <?php echo get_option('gwaa_tr_country')!=''?get_option('gwaa_tr_country'):'Country/Region';?>
		    </label>
		        <input id="<?php echo $tag->name;?>_country" name="<?php echo $tag->name;?>_country"  />
		     </div>
		    <?php 
		 	}
		 	if ($gwaa_enable_map==true) {
		 		
		 	
		    ?>
		    <div class="full-field">
		    	<div id="<?php echo $tag->name;?>map" class="gwaa_map"></div>
		    </div>
		    <?php
			}
		    ?>
        </div>
        <?php
        $html = ob_get_clean();
		return $html;
	}
	public function GWAA_add_products_tag_generator_menu()
	{
		$tag_generator = WPCF7_TagGenerator::get_instance();
		$tag_generator->add( 'gmautocomplete', __( 'Field Autocomplete', 'gwaa' ),array($this, 'GWAA_wpcf7_tag_products_generator_menu') );
	}
	function GWAA_wpcf7_tag_products_generator_menu( $contact_form, $args = '' ) {
		$args = wp_parse_args( $args, array() );
		$type = 'gmautocomplete';
		$description = __( "Generate a form-tag for a WooCommerce Products drop-down menu. For more details, see %s.", 'contact-form-7' );
	 	$gwaa_cf7_geo_api_key = get_option('gwaa_cf7_geo_api_key','');
		?>        
		  
		<div class="control-box">
			<fieldset>
				<legend><?php echo esc_html( $description ) ; ?></legend>
			<?php
			if($gwaa_cf7_geo_api_key==''){
			?>
			<a href="<?php echo get_admin_url().'admin.php?page=google-place-api';?>" target="_blank" style="font-weight: bold;color: red;">Setup Google Places API Key </a>
			<?php
			}
			?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
									<label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
								</fieldset>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /></td>
						</tr>

						
						
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
						</tr>
						
					</tbody>
				</table>
			</fieldset>
		</div>
		<div class="insert-box">
			<input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
			<div class="submitbox">
				<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
			</div>
			<br class="clear" />
			<p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
		</div>
		<?php
	}
	public function GWAA_products_validation_filter()
	{
		$tag = new WPCF7_Shortcode( $tag );
		$name = $tag->name;
		if ( isset( $_POST[$name] ) && is_array( $_POST[$name] ) ) {
			foreach ( $_POST[$name] as $key => $value ) {
				if ( '' === $value )
					unset( $_POST[$name][$key] );
			}
		}
		$empty = ! isset( $_POST[$name] ) || empty( $_POST[$name] ) && '0' !== $_POST[$name];
		if ( $tag->is_required() && $empty ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		}
		return $result;
	}
	
	
}
?>