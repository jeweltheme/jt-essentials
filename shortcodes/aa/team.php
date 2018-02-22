<?php

 function kc_aa_wp_team( $atts ){

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
        'post_type'     => 'team',
        'posts_per_page'  => $ppp
      );

    $teams = new WP_Query( $query_args );
?>

    <section class="about-us gray-bg">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                  <div class="section-details">
                      <div class="our-team text-center">
                          <?php
                            if ( $teams->have_posts() ) { while ( $teams->have_posts() ) { $teams->the_post();

                            $terms = wp_get_post_terms( $post->ID, 'team_category', array("fields" => "all"));

                            $team_member_name = aa_wp_meta( '_aa_wp_team_member_name' );
                            $team_member_designation = aa_wp_meta( '_aa_wp_team_member_designation' );
                            $team_desc = aa_wp_meta( '_aa_wp_team_desc' );
                            $social_twitter = aa_wp_meta( '_aa_wp_social_twitter' );
                            $social_facebook = aa_wp_meta( '_aa_wp_social_facebook' );
                            $social_dribbble = aa_wp_meta( '_aa_wp_social_dribbble' );
                            $social_google_plus = aa_wp_meta( '_aa_wp_social_google_plus' );
                            $social_linkedin = aa_wp_meta( '_aa_wp_social_linkedin' );
                            $social_instagram = aa_wp_meta( '_aa_wp_social_instagram' );
                            $social_email = aa_wp_meta( '_aa_wp_social_email' );

                            $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'aa_wp_team_thumb' );

                            $t = array();
                            foreach($terms as $term)
                                $t[] = $term->slug;
                              ?>
                              <div class="col-sm-4 col-xs-6">
                                  <div class="member">
                                      <div class="member-avatar">
                                          <img src="<?php echo esc_url( $url[0] ); ?>" alt="<?php the_title_attribute();?>">
                                      </div>
                                      <!-- /.member-avatar -->

                                      <div class="member-details">
                                          <h3 class="name"><?php echo esc_attr( $team_member_name );?></h3>
                                          <!-- /.name -->
                                          <span class="designation"><?php echo esc_attr( $team_member_designation );?></span>
                                          <!-- /.designation -->
                                          <p>
                                              <?php echo esc_attr( $team_desc );?>
                                          </p>
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
                                          </div>
                                          <!-- /.member-social -->
                                      </div>
                                      <!-- /.member-details -->
                                  </div>
                                  <!-- /.member -->
                              </div>
                          <?php wp_reset_postdata(); } } ?>

                      </div>
                      <!-- /.our-team -->
                  </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.about-us -->

    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_team', 'kc_aa_wp_team' );


function kc_aa_wp_team_params() {
    kc_add_map(
        array(

            'aa_wp_team' => array(
                    "icon" => 'fa fa-users',
                    "name" => esc_html__("Block: Team", 'js-essential'),
                    'description' => 'Show Team Block.',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name'  => 'ppp',
                            'label' => 'Show Team Count',
                            'type'  => 'textfield',
                            'value'  => '4',
                            'description' => esc_html__( 'Set Team Posts count. Set -1 to show all items.','jt-essential') ,
                        ),

                    )



                ),  // End of elemnt aa_wp_team


        )
    );
}

add_action('init', 'kc_aa_wp_team_params', 99 );

