<?php

 function kc_aa_wp_blog( $atts ){

    extract(
        shortcode_atts(
            array(
                    'ppp'           => '4'
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

        <section class="blog-posts gray-bg top-127 bottom-195">
                    <div class="section-details">
                        <?php if ( $blog_query->have_posts() ) { while ( $blog_query->have_posts() ) { $blog_query->the_post();
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'aa-wp-portfolio-square');
                            ?>

                            <div class="col-sm-6">
                                <article class="post type-post media">

                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="entry-thumbnail media-left">
                                            <img class="img-circle" src="<?php echo esc_url_raw( $image[0]);?>" alt="<?php the_title_attribute();?>">
                                        </div><!-- /.entry-thumbnail -->
                                    <?php } ?>
                                    <div class="entry-content media-body">
                                        <h3 class="entry-title">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_title();?>
                                            </a>
                                        </h3><!-- /.entry-title -->
                                        <div class="entry-meta">
                                            <span><i class="ti-calendar"></i>
                                                <time datetime="<?php echo get_the_modified_date( 'c' );?>"><?php echo get_the_date('M j, Y'); ?></time>
                                            </span>
                                            <span>
                                                    <a href="<?php comments_link(); ?>"><i class="ti-comment"></i>
                                                        <span class="count">
                                                            <?php comments_number( esc_html__( '0 Comment', 'aa-wp') , esc_html__( '1 Comment', 'aa-wp'), esc_html__( '% Comments', 'aa-wp') );?>
                                                        </span>
                                                    </a>
                                            </span>
                                        </div><!-- /.entry-meta -->
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->
                            </div>

                        <?php wp_reset_postdata(); } } ?>

                        <div class="btn-container">
                            <a href="<?php echo aa_wp_get_blog_link();?>" class="btn">
                                <?php echo esc_html__('Read all Posts', 'jt-essential');?>
                            </a>
                        </div>
                        <?php //echo function_exists('owlfolio_pagination') ? owlfolio_pagination() : posts_nav_link(); ?>

                    </div>
                </section>


    <?php


    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_blog', 'kc_aa_wp_blog' );


function kc_aa_wp_blog_params() {
        kc_add_map(
            array(

                'aa_wp_blog' => array(
                    'name' => esc_html__( 'Section: Blog', 'js-essential'),
                    'description' => esc_html__('Display Blog Section', 'js-essential'),
                    "icon" => 'fa fa-list',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ),
                    'params' => array(
                        array(
                            'name'  => 'ppp',
                            'label' => 'Posts Count',
                            'type'  => 'text',
                            'value'  => '4',
                        ),


                    )
                ),  // End of elemnt aa_wp_blog

            )
        ); // End add map



}

add_action('init', 'kc_aa_wp_blog_params', 99 );

