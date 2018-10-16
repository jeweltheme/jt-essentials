<?php

 function kc_bronx_works( $atts ){

 	extract(
 		shortcode_atts(
 			array(
	 				'portfolio_style'   	=> 'style1',
	 				'ppp'   				=> '12',
	 				'all_text'          	=> 'Show All',
	 				'portfolio_cat_list' 	=> '',
	 				'filter'            	=> 'all',
 				), $atts
 			)
 		);


 	global $post;

	// Fix for pagination
	if( is_front_page() ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	} else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}


	if (!( $filter == 'all' )) {
		if( function_exists( 'icl_object_id' ) ){
			$filter = (int)icl_object_id( $filter, 'portfolio_category', true);
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $portfolio_cat_list
			)
		);
	}

	if( $filter == 'all' ){
		$cats = get_categories('taxonomy=portfolio_category');
	} else {
		$cats = get_categories('taxonomy=portfolio_category&exclude='. $filter .'&child_of='. $filter);
	}


	if ( isset( $atts['portfolio_cat_list'] ) ) {
		$portfolio_cat_list = explode( ',', $atts['portfolio_cat_list'] );
		$portfolio_cat_list = array_map( 'trim', $portfolio_cat_list );
	} else {
		$portfolio_cat_list = array();
	}

	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $ppp,
		'include'    => $portfolio_cat_list,
		//'category__in'    => array( $portfolio_cat_list ),
		// 'tax_query' => array(
		// 	//'relation' => 'OR',
		// 	array (
		// 			'taxonomy' => 'portfolio_category',
		// 			'field' => 'term_id',
		// //			'terms' => array( $portfolio_cat_list )
		// 		)
		// 	),
		'orderby' => 'id',
		'order' => 'ASC'
	);

	ob_start();


	$portfolio_query = new WP_Query( $query_args );

	$count_posts = wp_count_posts( 'portfolio' )->publish;

	if( $portfolio_style == "style1" ){ ?>

	    <section class="works">
	        <div class="section-padding">
	            <div class="container">
	                <ul class="filter">
	                    <li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?></a></li>
						<?php
		                    $args = array(
		                            'include'        => $portfolio_cat_list,
		                            'post_type'      => 'portfolio',
		                            'orderby'       => 'id',
		                        );
		                    $portfolio_categories = get_terms( 'portfolio_category', $args );
		                    foreach ($portfolio_categories as $cat) {
		                    echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'</a></li>';
		                } ?>
	                </ul>

	                <div class="portfolio-works masonry-3column">

		                <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

		                      $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));
		                      $item_style = get_post_meta( $post->ID,'_bronx_portfolio_style',true );
		                      $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'aa-wp-portfolio-square' );

		                      $t = array();
		                      $t_n = array();
		                      foreach($terms as $term)
		                          $t[] = $term->slug;
		                          $t_n[] = $term->name;
		                      ?>

		                    <div class="item <?php echo implode(' ', $t); $t = array(); ?>">
		                        <?php if( $url ){ ?>
	                                    <img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
	                                <?php } ?>
		                        <div class="item-details">
		                            <div class="item-texts">
		                                <h3 class="item-title"><a href="<?php the_permalink();?>"><?php echo get_the_title($post->ID);?></a></h3><!-- /.item-title -->
		                                <p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
		                            </div><!-- /.item-texts -->
		                        </div><!-- /.item-details -->
		                    </div><!--/.item-->

						<?php } } wp_reset_postdata(); ?>

	                </div><!--/.portfolio-works-->

	            </div><!-- /.container -->
	        </div><!-- /.section-padding -->
	    </section><!-- /.works -->


	<?php } elseif( $portfolio_style == "style2" ){ ?>


    <section class="works">
        <div class="section-padding">
            <div class="container">
                <ul class="filter">
                    <li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?></a></li>
					<?php
	                    $args = array(
	                            'include'        => $portfolio_cat_list,
	                            'post_type'      => 'portfolio',
	                            'orderby'       => 'id',
	                        );
	                    $portfolio_categories = get_terms( 'portfolio_category', $args );
	                    foreach ($portfolio_categories as $cat) {
	                    echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'</a></li>';
	                } ?>
                </ul>

                <div class="portfolio-works masonry-3column">
	                <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

	                      $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));
	                      $item_style = get_post_meta( $post->ID,'_bronx_portfolio_style',true );
	                      $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

	                      $t = array();
	                      $t_n = array();
	                      foreach($terms as $term)
	                          $t[] = $term->slug;
	                          $t_n[] = $term->name;
	                      ?>

		                    <div class="item <?php echo implode(' ', $t); $t = array(); ?>">
		                        <?php if( $url ){ ?>
	                                <img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
	                             <?php } ?>
		                        <div class="item-details">
		                            <div class="item-texts">
		                                <h3 class="item-title"><a href="<?php the_permalink();?>"><?php echo get_the_title($post->ID);?></a></h3><!-- /.item-title --></h3><!-- /.item-title -->
		                                <p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
		                            </div><!-- /.item-texts -->
		                        </div><!-- /.item-details -->
		                    </div><!--/.item-->

						<?php } } wp_reset_postdata(); ?>

                </div><!--/.portfolio-works-->

            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.works -->


<?php

	}

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'bronx_works', 'kc_bronx_works' );


function kc_bronx_works_params() {
	global $post;

	$portfolio_category = array();
	$terms = get_terms( 'portfolio_category' );

	foreach($terms as $term){
		$portfolio_category[$term->term_id] = $term->name;
	}

	kc_add_map(
		array(

	        'bronx_works' => array(
	            	"icon" => 'fa fa-briefcase',
	        		"name" => esc_html__("Block: Portfolio", 'jt-essential'),
	        		'description' => 'Show Portfolio Works.',
	            	'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
	            	"params" => array(

						array(
							'name' => 'portfolio_style',
							'label' => esc_html__( 'Portfolio Style', 'jt-essential' ),
							'type' => 'select',
							'value' => 'style1',
		                	'options' => array(
			                		'style1' => esc_html__( 'Grid Style', 'jt-essential' ),
			                		'style2' => esc_html__( 'Masonry Style', 'jt-essential' )
			                )
		                ),

	                	array(
	                		'name'  => 'ppp',
	                		'label' => esc_html__( 'Portfolio Count', 'jt-essential' ),
	                		'type'  => 'textfield',
	                		'value'  => '12',
	                		'description' => esc_html__( 'Set Portfolio count. Set -1 to show all items.', 'jt-essential' ),
	                	),
	                	array(
	                		'name'  => 'all_text',
	                		'label' => esc_html__( 'Show All Text', 'jt-essential' ),
	                		'type'  => 'textfield',
	                		'value'  => esc_html__( 'All', 'jt-essential' ),
	                		'description' => esc_html__('Set Portfolio count. Set -1 to show all items.', 'jt-essential' )
	                	),
	                	array(
	                		'type'			=> 'multiple',
	                		'label'			=> esc_html__( 'Portfolio Category', 'jt-essential' ),
	                		'name'			=> 'portfolio_cat_list',
	                		'options'		=> $portfolio_category,
	                		'admin_label'	=> true
                		),
	                )

	            ),  // End of elemnt owlfolio_works

		)
	);
}

add_action('init', 'kc_bronx_works_params', 99 );

