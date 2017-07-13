<?php

 function kc_owlfolio_team( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'ppp'   			=> '4',	 				
	 				'filter'            => 'all',
 				), $atts 
 			) 
 		);

 	global $post;
	  
	  /**
	   * Setup post query
	   */
	  $query_args = array(
	    'post_type'     => 'team',
	    'posts_per_page'  => $ppp
	  );
	  
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
?>


	<div class="our-team">

        <?php
          $team = js_essential_get_custom_posts("team", $ppp);
          foreach ($team as $post) {              
              setup_postdata($post);
              $terms = wp_get_post_terms( $post->ID, 'team_category', array("fields" => "all"));                
              
              $team_member_name = owlfolio_meta( '_owlfolio_team_member_name' );
              $team_member_designation = owlfolio_meta( '_owlfolio_team_member_designation' );
              $team_desc = owlfolio_meta( '_owlfolio_team_desc' );
              $social_twitter = owlfolio_meta( '_owlfolio_social_twitter' );
              $social_facebook = owlfolio_meta( '_owlfolio_social_facebook' );
              $social_dribbble = owlfolio_meta( '_owlfolio_social_dribbble' );
              $social_google_plus = owlfolio_meta( '_owlfolio_social_google_plus' );
              $social_linkedin = owlfolio_meta( '_owlfolio_social_linkedin' );
              $social_instagram = owlfolio_meta( '_owlfolio_social_instagram' );
              $social_email = owlfolio_meta( '_owlfolio_social_email' );

              $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'owlfolio_team_thumb' );

              $t = array();                    
              foreach($terms as $term)
                  $t[] = $term->slug;
              ?>	

				<div class="member col-md-3 col-xs-6">
					<div class="member-avatar">
						<img src="<?php echo esc_url( $url[0] ); ?>" alt="Member Avatar">
						<div class="hover-content">
							<div class="member-social">

								<?php if( $social_facebook ){ ?>
									<a href="<?php echo esc_url_raw( $social_facebook );?>"><i class="fa fa-facebook"></i></a>
								<?php } if( $social_twitter ){ ?>
									<a href="<?php echo esc_url_raw( $social_twitter );?>"><i class="fa fa-twitter"></i></a>
								<?php } if( $social_dribbble ){ ?>
									<a href="<?php echo esc_url_raw( $social_dribbble );?>"><i class="fa fa-dribbble"></i></a>
								<?php } if( $social_google_plus ){ ?>
									<a href="<?php echo esc_url_raw( $social_google_plus );?>"><i class="fa fa-google-plus-circle"></i></a>
								<?php } if( $social_linkedin ){ ?>
									<a href="<?php echo esc_url_raw( $social_linkedin );?>"><i class="fa fa-linkedin"></i></a>
								<?php } if( $social_instagram ){ ?>
									<a href="<?php echo esc_url_raw( $social_instagram );?>"><i class="fa fa-instagram"></i></a>
								<?php } if( $social_email ){ ?>
									<a href="<?php echo esc_url_raw( $social_email );?>"><i class="fa fa-envelope-o"></i></a>									
								<?php } ?>
								
							</div><!-- /.member-social -->
						</div><!-- /.hover-content -->
					</div><!-- /.member-avatar -->
					<div class="member-details">
						<h3 class="name"><?php echo esc_attr( $team_member_name );?></h3><!-- /.name -->
						<span class="designation"><?php echo esc_attr( $team_member_designation );?></span><!-- /.designation -->
					</div><!-- /.member-details -->
				</div><!-- /.member -->
			
			<?php } ?>

	</div><!-- /.our-team -->



    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_team', 'kc_owlfolio_team' );

 
function kc_owlfolio_team_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_team' => array(
	            	"icon" => 'fa fa-users',
	        		"name" => esc_html__("Block: Team", 'js-essential'),
	        		'description' => 'Show Team Block.',	            	
	            	'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
	            	"params" => array(
	                	array(
	                		'name'  => 'ppp',
	                		'label' => 'Show Team Count',
	                		'type'  => 'textfield',
	                		'value'  => '4',
	                		'description' => esc_html__( 'Set Team Posts count. Set -1 to show all items.','jt-essential') ,
	                	),

	                )
	                


	            ),  // End of elemnt owlfolio_team 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_team_params', 99 );

