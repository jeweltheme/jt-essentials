<?php

 function kc_aa_wp_testimonial( $atts ){

    extract(
        shortcode_atts(
            array(
                    'testimonial_style'     => 'style1',
                    'ppp'                   => '4',
                    'filter'                => 'all',
                ), $atts
            )
        );

    global $post;

    ob_start();

    $query_args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => $ppp
    );
    $testimonials = new WP_Query( $query_args );
?>


<?php if( $testimonial_style == "style1" ){ ?>

    <section class="testimonial text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div id="testimonial-slider" class="testimonial-slider carousel slide">
                        <ol class="carousel-indicators">
                            <?php for($i = 0; $i<$ppp; $i++){ ?>
                                <li data-target="#testimonial-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">

                            <?php
                            $j=0;
                            if ( $testimonials->have_posts() ) { while ( $testimonials->have_posts() ) { $testimonials->the_post();

                                $testimonial_client_name        = aa_wp_meta( '_aa_wp_testimonial_client_name' );
                                $testimonial_client_designation = aa_wp_meta( '_aa_wp_testimonial_client_designation' );
                                $testimonial_client_company     = aa_wp_meta( '_aa_wp_testimonial_client_company' );
                                $testimonial_comments           = aa_wp_meta( '_aa_wp_testimonial_comments' );
                                $testimonial_client_url         = aa_wp_meta( '_aa_wp_testimonial_client_url' );


                                $testimonial_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 120, 120 )) ;
                                ?>

                                    <div class="item <?php echo ($j==0) ? "active" :"";?>">
                                        <div class="author-avatar"><img class="img-circle" src="<?php echo esc_url_raw( $testimonial_img[0] );?>" alt="<?php the_title_attribute();?>"></div><!-- /.author-avatar -->
                                        <div class="item-details">
                                            <p>
                                                <?php echo htmlspecialchars_decode( $testimonial_comments ); ?>
                                            </p>
                                            <h3 class="name"><?php echo esc_attr( $testimonial_client_name ); ?></h3><!-- /.name -->
                                            <span class="company"><?php echo esc_attr( $testimonial_client_company ); ?></span><!-- /.company -->
                                        </div>
                                    </div>

                                <?php $j++; wp_reset_postdata(); } } ?>


                        </div>
                    </div><!-- /.testimonial-slider -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.testimonial -->



<?php } elseif( $testimonial_style == "style2" ){ ?>
    <section class="testimonial testimonial-02 gray-bg">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div id="testimonial-slider" class="testimonial-slider carousel slide">
                        <ol class="carousel-indicators">
                            <?php for($i = 0; $i<$ppp; $i++){ ?>
                                <li data-target="#testimonial-slider" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $j=0;
                            if ( $testimonials->have_posts() ) { while ( $testimonials->have_posts() ) { $testimonials->the_post();

                                $testimonial_client_name        = aa_wp_meta( '_aa_wp_testimonial_client_name' );
                                $testimonial_client_designation = aa_wp_meta( '_aa_wp_testimonial_client_designation' );
                                $testimonial_client_company     = aa_wp_meta( '_aa_wp_testimonial_client_company' );
                                $testimonial_comments           = aa_wp_meta( '_aa_wp_testimonial_comments' );
                                $testimonial_client_url         = aa_wp_meta( '_aa_wp_testimonial_client_url' );


                                $testimonial_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( 120, 120 )) ;
                                ?>
                                    <div class="item media <?php echo ($j==0) ? "active" :"";?>">
                                        <div class="author-avatar text-center media-left">
                                            <img class="img-circle" src="<?php echo esc_url_raw( $testimonial_img[0] );?>" alt="<?php the_title_attribute();?>">
                                        </div>
                                        <!-- /.author-avatar -->
                                        <div class="item-details media-body">
                                            <h3 class="name"><?php echo esc_attr( $testimonial_client_name ); ?></h3>
                                            <!-- /.name -->
                                            <span class="company"><?php echo esc_attr( $testimonial_client_company ); ?></span>
                                            <!-- /.company -->
                                            <p>
                                                <?php echo htmlspecialchars_decode( $testimonial_comments ); ?>
                                            </p>
                                        </div>
                                    </div>

                                <?php $j++; wp_reset_query(); } } ?>

                        </div>
                    </div>
                    <!-- /.testimonial-slider -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.section-padding -->
    </section>
    <!-- /.testimonial -->



<?php } ?>



    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_testimonial', 'kc_aa_wp_testimonial' );


function kc_aa_wp_testimonial_params() {
    kc_add_map(
        array(

            'aa_wp_testimonial' => array(
                    "icon" => 'fa fa-quote-left',
                    "name" => esc_html__("Block: Testimonial", 'js-essential'),
                    'description' => esc_html__( 'Show Testimonial Block.', 'jt-essential' ) ,
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name' => 'testimonial_style',
                            'label' => __( 'Testimonial Style', 'js-essential' ),
                            'type' => 'select',
                            'value' => 'style1',
                            'options' => array(
                                'style1' => __( 'Style 1', 'js-essential' ),
                                'style2' => __( 'Style 2', 'js-essential' ),
                            ),
                        ),
                        array(
                            'name'  => 'ppp',
                            'label' => 'Show Testimonial Count',
                            'type'  => 'textfield',
                            'value'  => '4',
                            'description' => esc_html__( 'Set Testimonial Posts count. Set -1 to show all items.','jt-essential') ,
                        ),

                    )



                ),  // End of elemnt aa_wp_testimonial


        )
    );
}

add_action('init', 'kc_aa_wp_testimonial_params', 99 );

