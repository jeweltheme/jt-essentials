<?php

 function kc_bronx_client_logos( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'client_title' => 'Our Clients',
	 				'client_logos' => '',
 				), $atts 
 			) 
 		);
	ob_start();
?>


	<h3 class="section-title">
		<?php echo $client_title;?>
	</h3><!-- /.section-title -->
	<div class="clients">
		        <?php
		        $i = 1; 
		        $imgs = explode(',', $client_logos);
		        if( is_array($imgs) ){
		            foreach( $imgs as $ID ){
		            	$bg_img = wp_get_attachment_image_src( $ID, 'full');	            		            	
		        	?>	
	    			<a href="<?php echo esc_url_raw( get_post_meta( $ID, "_client_url", true ) );?>" target="_blank">
	    				<img src="<?php echo $bg_img[0];?>" alt="<?php the_title_attribute();?>">
	    			</a>
	    		<?php $i++; } } ?>
	</div>



    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'bronx_client_logos', 'kc_bronx_client_logos' );

 
function kc_bronx_client_logos_params() {

	
	if( !is_admin()){
		wp_enqueue_style( 'bronx-home-construction',BRONX_CSS . "/home/home-construction.css" );	
	}
	
		
	kc_add_map(
		array(	
	            
	        'bronx_client_logos' => array(
	            	"icon" => 'fa fa-user',
	        		"name" => esc_html__("Block: Client Logos", 'js-essential'),
	        		'description' => 'Select Images for Clients',	            	
	            	'category' => esc_html__( 'Bronx', 'jt-essential' ) ,
	            	"params" => array(
	            		array(
	                		'name'  => 'client_title',
	                		'label' => 'Section Title',
	                		'type'  => 'text',
	                		'value'  => 'Our Clients',
	                	),
						array(
							'name'			=> 'client_logos',
							'type'			=> 'attach_images',
							'label'			=> esc_html__( 'Client Logos', 'js-essential' ),							
							'description'	=> esc_html__( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
							'admin_label'	=> true,	                		
						),

	                )
	                


	            ),  // End of elemnt bronx_client_logos 

	        
		) 
	);
}

add_action('init', 'kc_bronx_client_logos_params', 99 );

