<?php

 function kc_victor_carousel_slider( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'images' 			=>  ''	 			
 				), $atts 
 			) 
 		);

	ob_start();		
	?>



    <div class="carousel-wrapping halfheight">
        <div class="owl-carousel halfheight featured-carousel">                        

		        <?php
			        $i = 1; 
			        $imgs = explode(',', $images);
			        if( is_array($imgs) ){
			            foreach( $imgs as $ID ){
			            	$bg_img = wp_get_attachment_image_src( $ID, 'full');
			        ?>
	        			<div class="featured-carousel-item featured-carousel-item-0<?php echo $i;?> halfheight" style="background-image: url('<?php echo $bg_img[0];?>');"></div>
        
        		<?php $i++; } } ?>

        </div>
    </div>

    <div class="clear"></div>

    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_carousel_slider', 'kc_victor_carousel_slider' );

 
function kc_victor_carousel_slider_params() {
	kc_add_map(
		array(	
	            
	        'victor_carousel_slider' => array(
	            	"icon" => 'cpicon kc-icon-icarousel',
	        		"name" => __("Section: Carousel", 'js-essential'),
	        		'description' => 'Show Carousel Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(

						array(
							'name'			=> 'images',
							'type'			=> 'attach_images',
							'label'			=> __( 'Slider Images', 'js-essential' ),							
							'description'	=> __( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
							'admin_label'	=> true					
						),





	                )
	                


	            ),  // End of elemnt victor_carousel_slider 

	        
		) 
	);
}

add_action('init', 'kc_victor_carousel_slider_params', 99 );

