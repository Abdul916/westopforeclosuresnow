<?php
/**
* This class is loaded on the front-end since its main job is
* to display the WhatsApp box.
*/
class GMDPCF_Display {
	
	public function __construct () {
		add_action('wpcf7_init', array($this, 'GMDPCF_cf7_datepicker_add_tag_generator'));
		add_action( 'admin_init', array($this, 'GMDPCF_add_products_tag_generator_menu'));
		add_action( 'wpcf7_validate_datepicker', array($this, 'GMDPCF_products_validation_filter'), 20, 2);
		add_action( 'wpcf7_validate_datepicker*', array($this, 'GMDPCF_products_validation_filter'), 20, 2);
	}
	
	public function GMDPCF_cf7_datepicker_add_tag_generator()
	{
		
		wpcf7_add_form_tag( array( 'datepicker', 'datepicker*' ),array($this, 'GMDPCF_wpcf7_cfpl_products_shortcode_handler'),true);
		
		
		
	}
	public function GMDPCF_wpcf7_cfpl_products_shortcode_handler( $tag )
	{
		
		if (empty($tag->name)) 
		{
			return '';
		}
		
		$validation_error = wpcf7_get_validation_error( $tag->name );
		$class = wpcf7_form_controls_class( $tag->type, 'datepicker' );
	
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
		$atts['class']		.= ' gmdpcf_datepicker';
		$atts['placeholder'] = $tag->get_option( 'placeholder', '', true );

		$atts['format'] = $tag->get_option( 'format', '', true );
		$atts['min_val'] = $tag->get_option( 'min_val', '', true );
		if($atts['min_val']==''){
			$atts['min_val'] = 'no_limit';
		}
		$atts['max_val'] = $tag->get_option( 'max_val', '', true );
		if($atts['max_val']==''){
			$atts['max_val'] = 'no_limit';
		}
		if(!empty($tag->get_option( 'disable_weekdays'))){
			$atts['disable_weekdays'] = implode("|",$tag->get_option( 'disable_weekdays'));
		}else{
			$atts['disable_weekdays'] = '';
		}
		

		if ( $tag->has_option( 'readonly' ) ) 
		{
			$atts['readonly'] = 'readonly';
		}

		if ( $tag->is_required() ) 
		{
			$atts['aria-required'] = 'true';
		}
		$atts['aria-invalid'] = $validation_error ? 'true' : 'false';
		
		
		
		if ( $tag->has_option( 'placeholder' ) )
		{
			$place = $tag->get_option( 'placeholder', '[-0-9a-zA-Z_\s]+', true );
			$place = str_replace("_", " ", $place);
			$atts['placeholder'] = $place;
		}			
		$atts['type']	= 'text';
		$atts['name']	= $tag->name;
		$atts = wpcf7_format_atts($atts);
        $this->fields[$tag->name]   = $tag->values;
        $this->names[]  = $tag->name;   
        

        ob_start();
        ?>
        <span  class="wpcf7-form-control-wrap <?php echo sanitize_html_class( $tag->name )?>" data-name="<?php echo sanitize_html_class( $tag->name )?>">
        	<input <?php echo $atts;?> />
        	<?php echo $validation_error;?>
		</span >
        <?php
        $html = ob_get_clean();
		return $html;
	}
	public function GMDPCF_add_products_tag_generator_menu()
	{
		$tag_generator = WPCF7_TagGenerator::get_instance();
		$tag_generator->add( 'datepicker', __( 'Date Picker', 'gmdpcf' ),array($this, 'GMDPCF_wpcf7_tag_products_generator_menu') );
	}
	function GMDPCF_wpcf7_tag_products_generator_menu( $contact_form, $args = '' ) {
		$args = wp_parse_args( $args, array() );
		$type = 'datepicker';
		$description = __( "Generate a form-tag for a Date Picker. For more details, see %s.", 'contact-form-7' );
		?>
		<div class="control-box">
			<fieldset>
				<legend><?php echo esc_html( $description ) ; ?></legend>
			
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
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-placeholder' ); ?>"><?php echo esc_html( __( 'Placeholder attribute', 'contact-form-7' ) ); ?></label></th>
							<td>
								<input type="text" name="placeholder" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-placeholder' ); ?>" />
								<br/>
								For adding space in placeholder instead of space add <code>_</code>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label></th>
							<td><input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
						</tr>

						<tr>
							<th scope="row">
								<label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Date Format', 'contact-form-7' ) ); ?></label>
							</th>
							<td>
								<input type="text" name="format" class="formatvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-format' ); ?>" />
								<code>Example: yy-mm-dd</code>
								<a href="https://api.jqueryui.com/datepicker/#option-dateFormat" target="_blank">Date Format</a>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Min Date', 'contact-form-7' ) ); ?></label>
							</th>
							<td>
								<select class="min_type">
									<option value="no_limit">No Limit</option>
									<option value="current">Current Date</option>
									<option value="set_date">Set Date</option>
									<option value="field_name">Linked Field Name</option>
								</select>
								<div class="min_set_date_upper" style="display: none;">
									<input type="text" name="min_set_date" class="min_set_date"  id="<?php echo esc_attr( $args['content'] . '-min_set_date' ); ?>" /><code>Example: <?php echo date('Y-m-d');?></code>
								</div>
								<div class="min_current_upper" style="display: none;">
									<select class="min_current_type">
										<option value="plus">+</option>
										<option value="minus">-</option>
									</select>
									<input type="number" name="min_current" class="min_current"  id="<?php echo esc_attr( $args['content'] . '-min_current' ); ?>" value="0" /></code>
									<select class="min_current_days">
										<option value="days">Days</option>
										<option value="weeks">Weeks</option>
										<option value="months">Months</option>
										<option value="year">Years</option>
									</select>
								</div>
								<div class="min_field_name_upper" style="display: none;">
									<input type="text" name="min_field_name" class="min_field_name"  id="<?php echo esc_attr( $args['content'] . '-min_field_name' ); ?>" /><code>Example: datepicker-1</code>
								</div>
								<input type="hidden" name="min_val" class="min_val oneline option"  id="<?php echo esc_attr( $args['content'] . '-min_val' ); ?>" />
							</td>
						</tr>


						<tr>
							<th scope="row">
								<label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Max Date', 'contact-form-7' ) ); ?></label>
							</th>
							<td>
								<select class="max_type">
									<option value="no_limit">No Limit</option>
									<option value="current">Current Date</option>
									<option value="set_date">Set Date</option>
									<option value="field_name">Linked Field Name</option>
								</select>
								<div class="max_set_date_upper" style="display: none;">
									<input type="text" name="max_set_date" class="max_set_date"  id="<?php echo esc_attr( $args['content'] . '-max_set_date' ); ?>" /><code>Example: <?php echo date('Y-m-d');?></code>
								</div>
								<div class="max_current_upper" style="display: none;">
									<select class="max_current_type">
										<option value="plus">+</option>
										<option value="minus">-</option>
									</select>
									<input type="number" name="max_current" class="max_current"  id="<?php echo esc_attr( $args['content'] . '-max_current' ); ?>" value="0" /></code>
									<select class="max_current_days">
										<option value="days">Days</option>
										<option value="weeks">Weeks</option>
										<option value="months">Months</option>
										<option value="year">Years</option>
									</select>
								</div>
								<div class="max_field_name_upper" style="display: none;">
									<input type="text" name="max_field_name" class="max_field_name"  id="<?php echo esc_attr( $args['content'] . '-max_field_name' ); ?>" /><code>Example: datepicker-1</code>
								</div>
								<input type="hidden" name="max_val" class="max_val oneline option"  id="<?php echo esc_attr( $args['content'] . '-max_val' ); ?>" />
							</td>
						</tr>

						<tr>
							<th scope="row"><?php echo esc_html( __( 'Disable Week Days', 'contact-form-7' ) ); ?></th>
							<td>
								<fieldset>
									<label><input type="checkbox" name="disable_weekdays:sunday" class="option" /> <?php echo esc_html( __( 'Sunday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:monday" class="option"/> <?php echo esc_html( __( 'Monday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:tuesday" class="option"/> <?php echo esc_html( __( 'Tuesday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:wednesday" class="option"/> <?php echo esc_html( __( 'Wednesday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:thursday" class="option"/> <?php echo esc_html( __( 'Thursday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:friday" class="option"/> <?php echo esc_html( __( 'Friday', 'contact-form-7' ) ); ?></label>
									<label><input type="checkbox" name="disable_weekdays:saturday" class="option"/> <?php echo esc_html( __( 'Saturday', 'contact-form-7' ) ); ?></label>
								</fieldset>
							</td>
						</tr>
						
						
					</tbody>
				</table>
			</fieldset>
		</div>
		<div class="insert-box">
			<input type="text" name="<?php echo esc_attr($type); ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
			<div class="submitbox">
				<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
			</div>
			<br class="clear" />
			<p class="description mail-tag"><label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" /></label></p>
		</div>
		<?php
	}
	public function GMDPCF_products_validation_filter($result,$tag )
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