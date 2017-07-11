<?php

 function kc_owlfolio_testimonial( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'ppp'   			=> '4',	 				
	 				'filter'            => 'all',
 				), $atts 
 			) 
 		);

 	global $post;

	ob_start();
?>

		<div id="testimonial-slider-03" class="testimonial-slider-03 carousel slide text-center" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php
				$query_args = array(
					'post_type' => 'testimonial',
					'posts_per_page' => $ppp
					);
				$testimonials = new WP_Query( $query_args );

				$j=0;
				if ( $testimonials->have_posts() ) { while ( $testimonials->have_posts() ) { $testimonials->the_post();                                                 

					$testimonial_client_name        = owlfolio_meta( '_owlfolio_testimonial_client_name' );
					$testimonial_client_designation = owlfolio_meta( '_owlfolio_testimonial_client_designation' );
					$testimonial_client_company     = owlfolio_meta( '_owlfolio_testimonial_client_company' );
					$testimonial_comments           = owlfolio_meta( '_owlfolio_testimonial_comments' );
					$testimonial_client_url         = owlfolio_meta( '_owlfolio_testimonial_client_url' );


					$testimonial_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 120, 120 )) ; 
					?>

						<div class="item <?php echo ($j==0) ? "active" :"";?>">
							<div class="author-avatar">
								<img class="img-circle" src="<?php echo esc_url_raw( $testimonial_img[0] );?>" alt="<?php the_title_attribute();?>">
							</div><!-- /.author-avatar -->
							<div class="item-details">
								<p>
									<?php echo htmlspecialchars_decode( $testimonial_comments ); ?>
								</p>
								<h4 class="name"><?php echo esc_attr( $testimonial_client_name ); ?></h4><!-- /.name -->
								<span class="designation"><?php echo esc_attr( $testimonial_client_company ); ?></span><!-- /.designation -->
							</div><!-- /.item-details -->
						</div><!-- /.item -->

				<?php $j++; wp_reset_query(); } } ?>

			</div><!-- /.carousel-inner -->
		</div><!-- /.testimonial-slider-03 -->



    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_testimonial', 'kc_owlfolio_testimonial' );

 
function kc_owlfolio_testimonial_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_testimonial' => array(
	            	"icon" => 'fa fa-briefcase',
	        		"name" => esc_html__("Block: Testimonial", 'js-essential'),
	        		'description' => esc_html__( 'Show Testimonial Block.', 'jt-essential' ) ,
	            	'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
	            	"params" => array(
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Show Testimonial Count',
	                		'type'  => 'textfield',
	                		'value'  => '4',
	                		'description' => esc_html__( 'Set Testimonial Posts count. Set -1 to show all items.','jt-essential') ,
	                	),

	                )
	                


	            ),  // End of elemnt owlfolio_testimonial 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_testimonial_params', 99 );

