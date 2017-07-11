<?php

 function kc_victor_blog( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'ppp' 			=> '3'	 				
 				), $atts 
 			) 
 		);

	ob_start();

	global $post;

	// Fix for pagination
	if( is_front_page() ) { 
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
	} else { 
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
	}

	$query_args = array(
		'post_type' => 'post',
		'ignore_sticky_posts' => true,
		'posts_per_page' => $ppp,
		'paged' => $paged
	);
	
	$blog_query = new WP_Query( $query_args );
	?>


    <div id="about" class="blog-section pad-top pad-bottom white-bg">
      <div class="container">

			<?php if ( $blog_query->have_posts() ) { while ( $blog_query->have_posts() ) { $blog_query->the_post();

						get_template_part( 'template-parts/content');

						echo function_exists('victor_pagination') ? victor_pagination() : posts_nav_link();
					} 
				}
				wp_reset_postdata();				
			?>
	    
      </div>
    </div>




    <?php 


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_blog', 'kc_victor_blog' );

 
function kc_victor_blog_params() {
 	    kc_add_map(
	        array(

	            'victor_blog' => array(
	                'name' => esc_html__( 'Blog Section', 'js-essential'),
	                'description' => esc_html__('Display single icon', 'js-essential'),
	                "icon" => 'fa fa-list',
	                'category' => 'Victor',
	                'params' => array(
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Posts Count',
	                		'type'  => 'text',
	                		'value'  => '3',
	                	),
	                	

	                )
	            ),  // End of elemnt victor_blog 

	        )
	    ); // End add map



}  

add_action('init', 'kc_victor_blog_params', 99 );

