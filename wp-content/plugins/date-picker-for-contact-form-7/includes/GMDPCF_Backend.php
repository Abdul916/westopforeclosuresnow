<?php
/**
* This class is loaded on the front-end since its main job is
* to display the WhatsApp box.
*/
class GMDPCF_Backend {
	
	public function __construct () {
		add_action('admin_menu', array($this,'GMDPCF_cf7_address_autocomplete_menu_item'));
		add_action('admin_init', array($this,'GMDPCF_cf7_address_autocomplete_display_gpa_fields'));
		add_action( 'admin_enqueue_scripts', array($this,'GMWPLW_scripts' ));
	}
	public function GMDPCF_cf7_address_autocomplete_menu_item()
	{
		add_submenu_page(
											'wpcf7',
											__('Date Picker Option','contact-form-7'),
											__('Date Picker Option','contact-form-7'), 
											'manage_options',
											'date-picker-cf7op',
											array($this, 'GMDPCF_cf7_google_place_admin' ),
										);
	}
	public function GMDPCF_cf7_google_place_admin()
	{
		$gmdpcf_country_code = get_option('gmdpcf_country_code','');
		$gmdpcf_address_option = get_option('gmdpcf_address_option',array());
		if(empty($gmdpcf_address_option)){
        	$gmdpcf_address_option = array();
        }

        $gmdpcf_skin_arr = array('base','black-tie','blitzer','cupertino','dark-hive','dot-luv','eggplant','excite-bike','flick','hot-sneaks','humanity','le-frog','mint-choc','overcast','pepper-grinder','redmond','smoothness','south-street','start','sunny','swanky-purse','trontastic','ui-darkness','ui-lightness','vader');
        $gmdpcf_skin = get_option( 'gmdpcf_skin' );
?>
		<div class="wrap">
			<h1>Date Picker Option</h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'gmdpcf_section' ); ?>
				<table class="form-table" role="presentation">
				   <tbody>
				      
			         <tr valign="top">
			            <th scope="row">
			               <label>Skin</label>
			            </th>
			            <td>
			            	 <select name="gmdpcf_skin">
			            	 	<?php
			            	 	foreach($gmdpcf_skin_arr as $gmdpcf_skin_arr_key=>$gmdpcf_skin_arr_val){
			            	 		echo '<option value="'.esc_attr($gmdpcf_skin_arr_val).'" '.(($gmdpcf_skin==$gmdpcf_skin_arr_val)?'selected':'').'>'.esc_attr($gmdpcf_skin_arr_val).'</option>';
			            	 	}
			            	 	?>
			            	 </select>
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
	
	public function GMDPCF_cf7_address_autocomplete_display_gpa_fields()
	{
		
			
			register_setting('gmdpcf_section', 'gmdpcf_skin');
	  
	}

	public function GMWPLW_scripts()
	{
		$gmdpcf_skin = 'base';
		wp_enqueue_style('gmdpcf-jquery-ui-admin', GMDPCF_PLUGIN_URL . '/assents/jquery-ui-themes/themes/'.$gmdpcf_skin.'/jquery-ui.css', array(), '1.0.0', 'all');

		wp_enqueue_style('gmdpcf-jquery-ui-theme-admin', GMDPCF_PLUGIN_URL . '/assents/jquery-ui-themes/themes/'.$gmdpcf_skin.'/theme.css', array(), '1.0.0', 'all');
		wp_enqueue_script('gmwplw-script-admin', GMDPCF_PLUGIN_URL . 'assents/js/admin-script.js', array('jquery-ui-datepicker'), '1.0.0', true );
	}
	
	
}
?>