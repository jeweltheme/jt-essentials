<?php

 function kc_owlfolio_blog( $atts ){
 	
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


	   <div class="blog-posts">
	   
  			<?php
  				if ( have_posts() ) { while ( have_posts() ) { the_post(); 
  						get_template_part( 'template-parts/content');
  				} } else { 
  					get_template_part( 'template-parts/content', 'none' ); 
  				}
  				
  				echo function_exists('owlfolio_pagination') ? owlfolio_pagination() : posts_nav_link();
  			?>

		</div><!-- /.blog-posts -->




    <?php 


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_blog', 'kc_owlfolio_blog' );

 
function kc_owlfolio_blog_params() {
 	    kc_add_map(
	        array(

	            'owlfolio_blog' => array(
	                'name' => esc_html__( 'Blog Section', 'js-essential'),
	                'description' => esc_html__('Display single icon', 'js-essential'),
	                "icon" => 'fa fa-list',
	                'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
	                'params' => array(
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Posts Count',
	                		'type'  => 'text',
	                		'value'  => '3',
	                	),
	                	

	                )
	            ),  // End of elemnt owlfolio_blog 

	        )
	    ); // End add map



}  

add_action('init', 'kc_owlfolio_blog_params', 99 );

