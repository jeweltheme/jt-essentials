<?php

 function kc_owlfolio_works( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'portfolio_style'   	=> 'style1',
	 				'ppp'   				=> '12',
	 				'all_text'          	=> 'Show All',
	 				'pppage' 				=> '999',
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
	
	/**
	 * Setup post query
	 */
	$query_args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $ppp,
		//'paged' => $paged,

		'tax_query' => array(
			array (
					'taxonomy' => 'portfolio_category',
					'field' => 'term_id',
					'terms' => array( $portfolio_cat_list )
				)
			)
	);
	
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

	
	$portfolio_query = new WP_Query( $query_args );	

	$count_posts = wp_count_posts( 'portfolio' )->publish;

	ob_start();

	if( $portfolio_style == "style1" ){ ?>

	    <div class="portfolio-works">
	        <ul class="filter right-side">
	            <li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?> <span class="count"><?php echo $count_posts;?></span></a></li>            
	            <?php 
	            $category = get_terms( 'portfolio_category' );
	            foreach ($category as $cat) { 
	            	echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
	            } ?> 
	        </ul>

	        <div class="portfolio-items grid-3column-01">

	            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

	                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
	                  $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );
	                  $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_small' );                  

	                  $t = array();                    
	                  $t_n = array();                    
	                  foreach($terms as $term)
	                      $t[] = $term->slug;
	                      $t_n[] = $term->name;
	                  ?>

			        	<div class="item col-xs-4 <?php echo implode(' ', $t); $t = array(); ?>">
			        		<div class="item-inner">

			        			<?php if( $url ){ ?>
			        				<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
			        			<?php } ?>		        			

			        			<div class="item-details">
			        				<div class="item-texts">
			        					<h3 class="item-title">
			        						<a href="<?php the_permalink();?>">
			        							<?php echo get_the_title($post->ID);?>
			        						</a>
			        					</h3><!-- /.item-title -->
			        					<p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
			        				</div><!-- /.item-texts -->
			        			</div><!-- /.item-details -->
			        		</div>
			        	</div><!--/.item-->

			        <?php wp_reset_query(); } }?>

	        </div><!--/.portfolio-items-->
	    </div><!-- /.portfolio-works -->

	<?php } elseif( $portfolio_style == "style2" ){ ?>

			<div class="portfolio-works">
			 	<ul class="filter">
			 		<li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?> <span class="count"><?php echo $count_posts;?></span></a></li>
			 		<?php 
			 		$category = get_terms( 'portfolio_category' );
			 		foreach ($category as $cat) { 
			 			echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
			 		} ?> 
			 	</ul>

			 	<div class="portfolio-items masonry-2column-01">

		            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

		                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
		                  $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );

		                  switch ($item_style) {
		                  	case 'item-w2':		                  		
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_long_width' );
		                  		break;		                  	
		                  	case 'item-h2':
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_long_height' );
		                  		break;
		                  	
		                  	default:
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_medium_square' );
		                  		break;
		                  }
		                  

		                  $t = array();                    
		                  $t_n = array();                    
		                  foreach($terms as $term)
		                      $t[] = $term->slug;
		                      $t_n[] = $term->name;
		                  ?>

					 		<div class="item <?php if( $item_style == "item-w2" ) { echo "col-xs-12 "; } else{ echo "col-xs-6 "; } ?><?php echo esc_attr( $item_style );?> <?php echo implode(' ', $t); $t = array(); ?>">
					 			<div class="item-inner">
					 				
					 				<?php if( $url ){ ?>
						 				<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
					 				<?php } ?>

					 				<div class="item-details">
					 					<div class="item-texts">
					 						<h3 class="item-title">
					 							<a href="<?php the_permalink();?>">
					 								<?php echo get_the_title($post->ID);?>
					 							</a>
					 						</h3><!-- /.item-title -->
					 						<p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
					 					</div><!-- /.item-texts -->
					 				</div><!-- /.item-details -->
					 			</div>
					 		</div><!--/.item-->

					<?php wp_reset_query(); } }?>

			 	</div><!--/.portfolio-items-->
			 </div><!-- /.portfolio-works -->
	
	<?php } elseif( $portfolio_style == "style3" ){ ?>

			<div class="portfolio-works">

	            <ul class="filter right-side right-side-02">
			 		<li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?> <span class="count"><?php echo $count_posts;?></span></a></li>
			 		<?php 
			 		$category = get_terms( 'portfolio_category' );
			 		foreach ($category as $cat) { 
			 			echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
			 		} ?> 
	            </ul>

	            <div class="portfolio-items masonry-4column-01">
		            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

		                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
		                  $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );

		                  switch ($item_style) {
		                  	case 'item-w2':		                  		
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_long_width' );
		                  		break;		                  	
		                  	case 'item-h2':
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_long_height' );
		                  		break;
		                  	
		                  	default:
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_medium_square' );
		                  		break;
		                  }
		                  

		                  $t = array();                    
		                  $t_n = array();                    
		                  foreach($terms as $term)
		                      $t[] = $term->slug;
		                      $t_n[] = $term->name;
		                ?>

			                
			                <div class="item <?php if( $item_style == "item-w2" ) { echo "col-xs-6 "; } else{ echo "col-xs-3 "; } ?><?php echo esc_attr( $item_style );?> <?php echo implode(' ', $t); $t = array(); ?>">
			                    <div class="item-inner">

			                    	<?php if( $url ){ ?>
			                    		<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
			                    	<?php } ?>

			                        <div class="item-details">
			                            <div class="item-texts">
			                                <h3 class="item-title">
			                                	<a href="<?php the_permalink();?>">
					 								<?php echo get_the_title($post->ID);?>
					 							</a>
			                                </h3><!-- /.item-title -->
			                                <p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
			                            </div><!-- /.item-texts -->
			                        </div><!-- /.item-details -->
			                    </div>
			                </div><!--/.item-->

			        <?php wp_reset_query(); } } ?>


                </div><!--/.portfolio-items-->
            </div><!-- /.portfolio-works -->
	

	<?php } elseif( $portfolio_style == "style4" ){ ?>

		
		<div class="portfolio-works">
            <div class="portfolio-items fluid-items">

	            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

	                $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
	                $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );
					$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_blog_thumb_large' );
	                  

	                $t = array();                    
	                $t_n = array();                    
	                foreach($terms as $term)
	                    $t[] = $term->slug;
	                    $t_n[] = $term->name;
	                ?>

		                <div class="item">
		                
		                	<?php if( $url ){ ?>
			                	<div class="item-image">
			                		<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
			                	</div><!-- /.item-image -->		                		
		                	<?php } ?>
		                    
		                    <div class="item-details">
		                        <div class="item-texts">
		                            <h2 class="item-title">
		                            	<a href="<?php the_permalink();?>">
		                            		<?php echo get_the_title($post->ID);?>
		                            	</a>
		                            </h2><!-- /.item-title -->
		                            <p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>		                            
		                        </div><!-- /.item-texts -->
		                    </div><!-- /.item-details -->
		                </div><!-- /.item -->

		            <?php wp_reset_query(); } } ?>


            </div><!--/.portfolio-items-->
        </div><!-- /.portfolio-works -->

	<?php } elseif( $portfolio_style == "style5" ){ ?>

			<div class="portfolio-works">
				<ul class="filter right-side">
			 		<li><a class="active" href="#" data-filter="*"><?php echo esc_attr( $all_text ); ?> <span class="count"><?php echo $count_posts;?></span></a></li>
			 		<?php 
			 		$category = get_terms( 'portfolio_category' );
			 		foreach ($category as $cat) { 
			 			echo '<li><a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
			 		} ?> 
				</ul>

				<div class="portfolio-items masonry-3column-01">

		            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

		                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
		                  $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );

		                  switch ($item_style) {
		                  	case 'item-w2':		                  		
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_medium_square' );
		                  		break;		                  	
		                  	case 'item-h2':
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_long_height' );
		                  		break;
		                  	
		                  	default:
		                  		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_medium_square' );
		                  		break;
		                  }
		                  

		                  $t = array();                    
		                  $t_n = array();                    
		                  foreach($terms as $term)
		                      $t[] = $term->slug;
		                      $t_n[] = $term->name;
		                ?>

						<div class="item col-xs-4 <?php echo implode(' ', $t); $t = array(); ?>">
							<div class="item-inner">
								
								<?php if( $url ){ ?>
									<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
								<?php } ?>

								<div class="item-details">
									<div class="item-texts">
										<h3 class="item-title">
											<a href="<?php the_permalink();?>">
												<?php echo get_the_title($post->ID);?>
											</a>
										</h3><!-- /.item-title -->
										<p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
									</div><!-- /.item-texts -->
								</div><!-- /.item-details -->
							</div>
						</div><!--/.item-->

					<?php wp_reset_query(); } } ?>

				</div><!--/.portfolio-items-->
			</div><!-- /.portfolio-works -->

	<?php } elseif( $portfolio_style == "style6" ){ ?>

	        <div class="portfolio-works">

	            <div class="portfolio-items full-width">

		            <?php if ( $portfolio_query->have_posts() ) { while ( $portfolio_query->have_posts() ) { $portfolio_query->the_post();

		                  $terms = wp_get_post_terms( $post->ID, 'portfolio_category', array("fields" => "all"));  
		                  $item_style = get_post_meta( $post->ID,'_owlfolio_portfolio_style',true );

						  $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_portfolio_small_height' );		                  

		                  $t = array();                    
		                  $t_n = array();                    
		                  foreach($terms as $term)
		                      $t[] = $term->slug;
		                      $t_n[] = $term->name;
		                ?>

			                <div class="item">
			                	<div class="item-inner">

			                		<?php if( $url ){ ?>
			                			<img src="<?php echo esc_url_raw( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
			                		<?php } ?>

			                        <div class="item-details">
			                            <div class="item-texts">
			                                <h3 class="item-title">
			                                	<a href="<?php the_permalink();?>">
			                                		<?php echo get_the_title($post->ID);?>
			                                	</a>
			                                </h3><!-- /.item-title -->
			                                <p class="category"><?php echo implode(' ', $t_n); $t_n = array(); ?></p>
			                            </div><!-- /.item-texts -->
			                        </div><!-- /.item-details -->
			                    </div>
			                </div><!--/.item-->

			        <?php wp_reset_query(); } } ?>

	            </div><!-- /.portfolio-works -->
	        </div><!-- /.portfolio-works -->
	<?php } ?>




    <?php 	
		
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_works', 'kc_owlfolio_works' );

 
function kc_owlfolio_works_params() {
	global $post;

	$portfolio_category = array(); 
	$terms = get_terms( 'portfolio_category' );

	foreach($terms as $term){
		$portfolio_category[$term->term_id] = $term->name;		
	}

	kc_add_map(
		array(	
	            
	        'owlfolio_works' => array(
	            	"icon" => 'fa fa-briefcase',
	        		"name" => esc_html__("Block: Portfolio", 'jt-essential'),
	        		'description' => 'Show Portfolio Works.',	            	
	            	'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
	            	"params" => array(

						array(
							'name' => 'portfolio_style',
							'label' => esc_html__( 'Portfolio Style', 'jt-essential' ),
							'type' => 'select',
							'value' => 'style1',
		                	'options' => array(
			                		'style1' => esc_html__( 'Grid Box', 'jt-essential' ),
			                		'style2' => esc_html__( 'Masonry with Gap', 'jt-essential' ),
			                		'style3' => esc_html__( 'Masonry No-Gap', 'jt-essential' ),
			                		'style4' => esc_html__( 'Fluid Style', 'jt-essential' ),
			                		'style5' => esc_html__( 'Fullscreen Video Background', 'jt-essential' ),
			                		'style6' => esc_html__( 'Slanted Subtle Carousel', 'jt-essential' ),			                		
			                	),
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
	                		'value'  => esc_html__( 'Show All', 'jt-essential' ),
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

add_action('init', 'kc_owlfolio_works_params', 99 );

