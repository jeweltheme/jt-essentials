<?php

 function kc_victor_about_content( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'about_title' 			=>  'My Story',
	 				'about_content' 		=>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	 				'about_left' 			=>  'Etiam porta, diam quis semper malesuada, ex tortor facilisis sapien, hendrerit interdum velit massa ac libero. Nam sagittis arcu sed pellentesque sodales. Etiam tellus lectus, condimentum ac laoreet id, interdum ut tortor. In hac habitasse platea dictumst.',
	 				'about_right' 			=>  'Etiam porta, diam quis semper malesuada, ex tortor facilisis sapien, hendrerit interdum velit massa ac libero. Nam sagittis arcu sed pellentesque sodales. Etiam tellus lectus, condimentum ac laoreet id, interdum ut tortor. In hac habitasse platea dictumst.',
	 				'signature_image' 		=>  get_template_directory_uri() . '/images/sign.png',
 				), $atts 
 			) 
 		);

	ob_start();	
	
	$signature_image = wp_get_attachment_image_src( $signature_image, 'full');		
	?>


    <div id="about" class="about-section pad-top pad-bottom white-bg">
    	<div class="container">
    		<div class="row add-top add-bottom">
    			<div class="col-md-8 col-md-offset-2 text-left">
    				<h3 class="black font1 font-bold"><?php echo htmlspecialchars_decode( $about_title );?></h3><br/>
    				<h4 class="black font1 font-light"><?php echo htmlspecialchars_decode( $about_content );?></h4>

    				<div class="row add-top-quarter ">
    					<div class="col-md-6 text-left">
    						<p class="dark font1 font-light"><?php echo htmlspecialchars_decode( $about_left );?></p>
    					</div>
    					<div class="col-md-6 text-left">
    						<p class="dark font1 font-light"><?php echo htmlspecialchars_decode( $about_right );?></p>
    					</div>
    				</div>

    				<?php if( $signature_image ){ ?>
	    				<div class="row add-top-quarter ">
	    					<div class="signature col-md-3 text-left">
	    						<img alt="" title="" class="img-responsive" src="<?php echo $signature_image[0];?>"/>
	    					</div>
	    				</div>
    				<?php } ?>


    			</div>
    		</div>
    	</div>
    </div>



    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_about_content', 'kc_victor_about_content' );

 
function kc_victor_about_content_params() {
	kc_add_map(
		array(	
	            
	        'victor_about_content' => array(
	            	"icon" => 'fa fa-indent',
	        		"name" => __("Section: About Content", 'js-essential'),
	        		'description' => 'Show About Content Texts Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(

	                	array(
	                		'name'  => 'about_title',
	                		'label' => 'Title',
	                		'type'  => 'textfield',
	                		'value'  => 'My Story',
	                	),

	                	array(
	                		'name'  => 'about_content',
	                		'label' => 'Content',
	                		'type'  => 'textarea',
	                		'value'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
	                	),


	                	array(
	                		'name'  => 'about_left',
	                		'label' => 'Left Content Block',
	                		'type'  => 'textarea',
	                		'value'  => 'Etiam porta, diam quis semper malesuada, ex tortor facilisis sapien, hendrerit interdum velit massa ac libero. Nam sagittis arcu sed pellentesque sodales. Etiam tellus lectus, condimentum ac laoreet id, interdum ut tortor. In hac habitasse platea dictumst.',
	                	),

	                	array(
	                		'name'  => 'about_right',
	                		'label' => 'Right Content Block',
	                		'type'  => 'textarea',
	                		'value'  => 'Etiam porta, diam quis semper malesuada, ex tortor facilisis sapien, hendrerit interdum velit massa ac libero. Nam sagittis arcu sed pellentesque sodales. Etiam tellus lectus, condimentum ac laoreet id, interdum ut tortor. In hac habitasse platea dictumst.',
	                	),

	                	array(
	                		'name' => 'signature_image',
	                		'heading' => esc_html__( 'Signature Image' ,'js-essential'),
	                		'type' => 'attach_image',
	                		'value'	=> get_template_directory_uri() . '/images/sign.png'
	                	),


	                )
	                


	            ),  // End of elemnt victor_about_content 

	        
		) 
	);
}

add_action('init', 'kc_victor_about_content_params', 99 );