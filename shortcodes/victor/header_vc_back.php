<?php

 function kc_victor_header_section( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/06.jpg'
 				), $atts 
 			) 
 		);

	ob_start();

	

	?>


    <div id="header" class="header-section fullheight">

          <div class="overlay overlay-black">
          </div>

          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center fullheight">
              <div class="valign">
                <h1 class="white font1 font-light"><?php echo esc_attr( $title );?> <span class="white font1 font-bold"><?php echo wp_kses_post( $subtitle );?></span></h1>
              </div>
            </div>
          </div>

          <div class="floater">
              <a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
          </div>

    </div>



    <?php 

    add_action('wp_footer', function($atts){ 
    	 	extract( 
 		shortcode_atts( 
 			array(
	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/06.jpg'
 				), $atts 
 			) 
 		);

    	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');
    	?>

	    <script>
	      jQuery(window).load(function() {
	        //BG IMAGES for this page header
	          jQuery(".header-section").backstretch([
	              "<?php echo $bg_image[0];?>"
	          ], {duration: 3000, fade: 750});
	      });
	    </script>

    <?php });


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_header_section', 'kc_victor_header_section' );

 
function kc_victor_header_section_params() {
	vc_map( 
		array(	
	            	"icon" => 'victor-vc-block',
	            	"name" => __("Section: Heading", 'js-essential'),
	            	"base" => "victor_header_section",
	            	"category" => esc_html__('Victor WP Theme', 'js-essential'),
	            	'description' => 'Show Heading Section.',
	            	"params" => array(
	                	array(
	                		'name'  => 'title',
	                		'label' => 'Title',
	                		'type'  => 'textfield',
	                		'value'  => esc_html__( 'The Latest' ,'js-essential'),
	                	),
	                	array(
	                		'name'  => 'subtitle',
	                		'label' => 'Sub Title',
	                		'type'  => 'textfield',
	                		'value'  => wp_kses( 'News &amp; updates', 'js-essential' ) ,
	                	),
	                	array(
	                		'name' => 'bg_image',
	                		'label' => esc_html__( 'Upload Image' ,'js-essential'),
	                		'type' => 'attach_image',
	                		'admin_label' => true,
	                	),

	                


	            ),  // End of elemnt victor_header_section 

	        
		) 
	);
}

add_action('vc_before_init', 'kc_victor_header_section_params', 99 );


