<?php

 function kc_owlfolio_client_logos( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'client_logos' => ''
 				), $atts 
 			) 
 		);
	ob_start();
?>

            <div class="content-carousel-item about-carousel-item-0<?php echo $i;?> fullheight" style="background-image: url('<?php echo $bg_img[0];?>');"></div>
        
        

        <div class="client-logos">

	        <?php
	        

	        $i = 1; 
	        $imgs = explode(',', $client_logos);
	        if( is_array($imgs) ){
	            foreach( $imgs as $ID ){
	            	$bg_img = wp_get_attachment_image_src( $ID, 'full');	            		            	
	        	?>
	        	
		            <div class="col-sm-3 col-xs-6">
		                <a href="<?php echo esc_url_raw( get_post_meta( $ID, "_client_url", true ) );?>" target="_blank">
		                	<img src="<?php echo $bg_img[0];?>" alt="<?php the_title_attribute();?>">
		                </a>
		            </div>

	        <?php $i++; } } ?>

        </div><!-- /.client-logos -->


    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_client_logos', 'kc_owlfolio_client_logos' );

 
function kc_owlfolio_client_logos_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_client_logos' => array(
	            	"icon" => 'fa fa-briefcase',
	        		"name" => esc_html__("Block: Client Logos", 'js-essential'),
	        		'description' => 'Select Images for Clients',	            	
	            	'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
	            	"params" => array(
						array(
							'name'			=> 'client_logos',
							'type'			=> 'attach_images',
							'label'			=> esc_html__( 'Client Logos', 'js-essential' ),							
							'description'	=> esc_html__( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
							'admin_label'	=> true,	                		
						),

	                )
	                


	            ),  // End of elemnt owlfolio_client_logos 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_client_logos_params', 99 );

