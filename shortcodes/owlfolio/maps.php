<?php

 function kc_owlfolio_google_maps( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'lattitude' 		=>  '-37.834812',
	 				'longitude' 		=>  '144.963055',
 				), $atts 
 			) 
 		);

	ob_start();	
	?>
		<div class="map-container">
			<div id="googleMaps" class="googleMaps"></div>
		</div><!-- /.map-container -->

	<?php 
		//$google_api_key = $owlfolio_options['google_api_key'];	
		wp_enqueue_script( 'google-maps', "//maps.google.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM", array('jquery'), '', true );	

		// add_action('wp_footer', 'owlfolio_maps_script', 100, 2 );
		// function owlfolio_maps_script(){ ?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					"use strict";

						function isMobile() {
							return ('ontouchstart' in document.documentElement);
						}
						function init_gmap() {
							if ( typeof google == 'undefined' ) return;
							var options = {
								center: {lat: <?php echo esc_attr( $lattitude );?> , lng: <?php echo esc_attr( $longitude );?> },
								zoom: 15,
								mapTypeControl: true,
								mapTypeControlOptions: {
									style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
								},
								navigationControl: true,
								scrollwheel: false,
								streetViewControl: true,
								styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
							}
							if (isMobile()) {
								options.draggable = false;
							}
							$('#googleMaps').gmap3({
								map: {
									options: options
								},
			                    marker: {
			                       latLng: [ <?php echo esc_attr( $lattitude );?>, <?php echo esc_attr( $longitude );?> ],
			                        options: { icon: '<?php echo get_template_directory_uri();?>/images/map-icon.png' }
			                    }
			                });
						}				
						
						init_gmap();

					});
			</script>
	<?php 
	//}


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_google_maps', 'kc_owlfolio_google_maps' );

 
function kc_owlfolio_google_maps_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_google_maps' => array(
	            	"icon" => 'fa fa-map-marker',
	        		"name" => __("Block: Google Maps", 'jt-essential'),
	        		'description' => 'Google Maps Location',	            	
	            	'category' => 'Owlfolio',
	            	"params" => array(
	                	array(
	                		'name'  => 'lattitude',
	                		'label' => 'Lattitude',
	                		'type'  => 'textfield',
	                		'value'  => '-37.834812',
	                	),

	                	array(
	                		'name'  => 'longitude',
	                		'label' => 'Longitude',
	                		'type'  => 'textfield',
	                		'value'  => '144.963055',
	                	)
	                )

	            ),  // End of elemnt owlfolio_google_maps 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_google_maps_params', 99 );