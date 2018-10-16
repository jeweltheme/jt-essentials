<?php

 function kc_bronx_blog( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'blog_title' 			=> 'Latest News',
	 				'ppp' 					=> '3'	 				
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




    <section class="blog">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="secton-details">

                        <h2 class="section-title">
                        	<?php echo $blog_title;?>
                        </h2>

						<?php if ( $blog_query->have_posts() ) { while ( $blog_query->have_posts() ) { $blog_query->the_post();
							$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'bronx-home-blog-thumb');
							
								get_template_part( 'template-parts/content','home');

							} }
							wp_reset_postdata();				
						?>


                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.blog -->


    <?php 


	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'bronx_blog', 'kc_bronx_blog' );

 
function kc_bronx_blog_params() {
 	    kc_add_map(
	        array(

	            'bronx_blog' => array(
	                'name' => esc_html__( 'Blog Section', 'js-essential'),
	                'description' => esc_html__('Display single icon', 'js-essential'),
	                "icon" => 'fa fa-list',
	                'category' => 'Bronx',
	                'params' => array(
	                	array(
	                		'name'  => 'blog_title',
	                		'label' => 'Section Title',
	                		'type'  => 'text',
	                		'value'  => 'Latest News',
	                	),
	                	
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Posts Count',
	                		'type'  => 'text',
	                		'value'  => '3',
	                	),
	                	
	                )
	            ),  // End of elemnt bronx_blog 

	        )
	    ); // End add map



}  

add_action('init', 'kc_bronx_blog_params', 99 );

