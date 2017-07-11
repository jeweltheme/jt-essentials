<?php

 function kc_victor_works_section( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'ppp'   			=> '10',
	 				'all_text'          => 'All',
	 				'filter'            => 'all',
 				), $atts 
 			) 
 		);

 	global $post;
	  
	  /**
	   * Setup post query
	   */
	  $query_args = array(
	    'post_type'     => 'portfolio',
	    'posts_per_page'  => $ppp
	  );
	  
	  if (!( $filter == 'all' )) {
	    if( function_exists( 'icl_object_id' ) ){
	      $filter = (int)icl_object_id( $filter, 'portfolio_category', true);
	    }
	    $query_args['tax_query'] = array(
	      array(
	        'taxonomy' => 'portfolio_category',
	        'field' => 'id',
	        'terms' => $filter
	      )
	    );
	  }



	ob_start();
?>


    <div id="about" class="about-section pad-top pad-bottom white-bg">
      <div class="container">
           
        
              <!--works filter panel :starts -->
                <div class="works-filter-wrap autograph-kraft add-bottom-quarter">
                    <ul class="works-filter autograph-kraft text-left clearfix font3">
                        <li><a id="all" href="#" data-filter="*" class="active"><span><?php echo esc_attr( $all_text ); ?></span></a></li>                        
                        <?php 
                        $category = get_terms( 'portfolio_category' );
                        foreach ($category as $cat) { 
                        	echo '<li><a href="#" data-filter=".'.trim($cat->slug).'"><span>'.$cat->name.'</span></a></li>';
                        } ?> 
                    </ul>
              </div>
            <!-- works filter panel :ends -->

         <section id="works-container" class="works-container autograph-kraft works-masonry-container clearfix white-bg works-thumbnails-view">

            <?php
              $portfolio = js_essential_get_custom_posts("portfolio", $ppp);
              foreach ($portfolio as $post) {                  
                  setup_postdata($post);
                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
                  $portfolio_style = get_post_meta( $post->ID,'_victor_portfolio_style',true );

                  $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

                  $t = array();                    
                  foreach($terms as $term)
                      $t[] = $term->slug;
                  ?>


              <!-- start : works-item -->
              <div class="works-item autograph-kraft ImageWrapper works-item-one-third-spaced zoom <?php echo implode(' ', $t); $t = array(); ?> <?php echo $portfolio_style;?>">
                      <img data-no-retina alt="" title="" class="img-responsive" src="<?php echo esc_url_raw( $url[0] ); ?>"/>
                      <a  class="venobox" data-gall="portfolio-gallery" href="<?php echo esc_url_raw( $url[0] ); ?>">
                          <div class="works-item-inner ImageOverlayP">
                            <p class="valign text-center"><span class="white font2"><?php echo get_the_title($post->ID);?></span></p>
                          </div>
                      </a>
              </div>
              <!-- end : works-item -->

            <?php } ?>


        </section>
        <!-- end : works-container -->

    </div>
</div>



    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_works_section', 'kc_victor_works_section' );

 
function kc_victor_works_section_params() {
	kc_add_map(
		array(	
	            
	        'victor_works_section' => array(
	            	"icon" => 'fa fa-briefcase',
	        		"name" => __("Section: Works", 'js-essential'),
	        		'description' => 'Show Works Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Show Portfolio Count',
	                		'type'  => 'textfield',
	                		'value'  => '10',
	                		'description' => 'Set Portfolio count. Set -1 to show all items.',	            	
	                	),

	                )
	                


	            ),  // End of elemnt victor_works_section 

	        
		) 
	);
}

add_action('init', 'kc_victor_works_section_params', 99 );

