<?php

 function kc_victor_promo_slider( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'promo_text' 			=>  'Hello everyone, Welcome to official portfolio of <span>Victor Hernandes</span>, professional graphic designer, passionate photographer and hobbyist gamer'	 			
 				), $atts 
 			) 
 		);

	ob_start();		
	?>


    <div id="promo" class="promo-section pad-top pad-bottom white-bg">
      <div class="container">
            <div class="row add-top add-bottom">
              <div class="col-md-8 col-md-offset-2 text-center intro">
                  <h4 class="dark font1 font-light"><?php echo htmlspecialchars_decode( $promo_text );?> </h4>
              </div>
            </div>
      </div>
    </div>


    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_promo_slider', 'kc_victor_promo_slider' );

 
function kc_victor_promo_slider_params() {
	kc_add_map(
		array(	
	            
	        'victor_promo_slider' => array(
	            	"icon" => 'fa fa-beer',
	        		"name" => __("Section: Promo", 'js-essential'),
	        		'description' => 'Show Promo Texts Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(

	                	array(
	                		'name'  => 'promo_text',
	                		'label' => 'Title',
	                		'type'  => 'textarea',
	                		'value' => 'Hello everyone, Welcome to official portfolio of <span>Victor Hernandes</span>, professional graphic designer, passionate photographer and hobbyist gamer',
	                	),




	                )
	                


	            ),  // End of elemnt victor_promo_slider 

	        
		) 
	);
}

add_action('init', 'kc_victor_promo_slider_params', 99 );

