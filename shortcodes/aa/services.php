<?php

 function kc_aa_wp_services( $atts ){

    extract(
        shortcode_atts(
            array(
                    'ppp'               => '4',
                    'filter'            => 'all',
                ), $atts
            )
        );

    global $post;


      if (!( $filter == 'all' )) {
        if( function_exists( 'icl_object_id' ) ){
          $filter = (int)icl_object_id( $filter, 'team_category', true);
        }
        $query_args['tax_query'] = array(
          array(
            'taxonomy' => 'team_category',
            'field' => 'id',
            'terms' => $filter
          )
        );
      }

    ob_start();

      /**
       * Setup post query
       */
      $query_args = array(
        'post_type'     => 'service',
        'posts_per_page'  => $ppp
      );

    $services = new WP_Query( $query_args );

	ob_start();

	?>

	    <section class="services">
	        <div class="section-padding">
	            <div class="container">
	                <div class="row">
	                    <div class="services-items style-03">

	                    	<?php
	                    	$i = 1;
	                    	if ( $services->have_posts() ) { while ( $services->have_posts() ) { $services->the_post();
	                    		$url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'aa-wp-service-thumb' );
	                    		?>

			                        <div class="item">
			                            <div class="col-sm-6">
			                                <div class="item-image">
			                                    <img src="<?php echo esc_url( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
			                                </div><!-- /.item-image -->
			                            </div>
			                            <div class="col-sm-6">
			                                <div class="item-details">
			                                    <div class="title-area title-area-03">
			                                        <h2 class="item-title"><?php the_title();?></h2>
			                                        <span class="item-no">
			                                        	<?php if ($i < 10) {
			                                        		echo str_pad($i, 2, "0", STR_PAD_LEFT);
			                                        	} ?>
			                                        </span>
			                                    </div><!-- /.title-area -->
			                                    <p>
			                                        <?php the_content();?>
			                                    </p>
			                                </div><!-- /.item-details -->
			                            </div>
			                        </div><!-- /.item -->

							<?php wp_reset_postdata(); $i++; } } ?>

	                    </div><!-- /.services-items -->
	                </div><!-- /.row -->
	            </div><!-- /.container -->
	        </div><!-- /.section-padding -->
	    </section><!-- /.services -->



<?php

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}

add_shortcode( 'aa_wp_services', 'kc_aa_wp_services' );


function kc_aa_wp_services_params() {

	if( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( get_template_directory_uri().'/assets/css/themify-icons.css' );
	}

	kc_add_map(
		array(

		'aa_wp_services' => array(
			'name' => esc_html__('Block: Service', 'jt-essential'),
			'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
			'icon' => 'kc-icon-accordion',
			'title' => esc_html__('Service Settings', 'jt-essential'),
			'params' => array(

                       array(
                            'name'  => 'ppp',
                            'label' => 'Show Service Count',
                            'type'  => 'textfield',
                            'value'  => '4',
                            'description' => esc_html__( 'Set Service Posts count. Set -1 to show all items.','jt-essential') ,
                        ),




				),
			),



		)
	);
}

add_action('init', 'kc_aa_wp_services_params', 99 );