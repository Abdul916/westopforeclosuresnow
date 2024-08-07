<?php

class GMDPCF_Cron {
	
	public function __construct () {

		add_action( 'init', array( $this, 'GMDPCF_default' ) );
		
	}

	public function GMDPCF_default(){
		$defalarr = array(
			'gmdpcf_skin' => 'base',
			
			
		);
		
		foreach ($defalarr as $keya => $valuea) {
			if (get_option( $keya )=='') {
				update_option( $keya, $valuea );
			}
			
		}

		
		
	}
}

?>