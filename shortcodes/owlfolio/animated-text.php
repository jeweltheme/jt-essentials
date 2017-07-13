<?php

 function kc_owlfolio_animated_text( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	
	 				'animated_text' 		=>  esc_html__( 'We are OwlFolio Digital Agency. We combine smart design with rich technology to craft innovative brand & business solutions.', 'jt-essential' )
 				), $atts 
 			) 
 		);

	ob_start();	
	?>

	<div class="about-top text-center">
		<span> <?php echo wp_kses_post( $animated_text );?></span>
	</div><!-- /.about-top -->

<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_animated_text', 'kc_owlfolio_animated_text' );

 
function kc_owlfolio_animated_text_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_animated_text' => array(
	            	"icon" => 'fa fa-align-center',
	        		"name" => __("Block: Animated Text", 'jt-essential'),
	        		'description' => 'Animated Text.',	            	
	            	'category' => 'Owlfolio',
	            	"params" => array(

	                	array(
	                		'name'  => 'animated_text',
	                		'label' => 'Content',
	                		'type'  => 'textarea',
	                		'value'  => esc_html__( 'We are OwlFolio Digital Agency. We combine smart design with rich technology to craft innovative brand & business solutions.', 'jt-essentials') ,
	                	)
	                )

	            ),  // End of elemnt owlfolio_animated_text 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_animated_text_params', 99 );