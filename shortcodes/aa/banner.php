<?php

 function kc_aa_wp_banner( $atts ){

    extract(
        shortcode_atts(
            array(
                    'banner_image'            =>  get_template_directory_uri() . '/images/banner.png',
                    'banner_title'            =>  'We make Minimalism',
                    'banner_subtitle'         =>  'the most effective'
                ), $atts
            )
        );

    ob_start();
    $banner_image = wp_get_attachment_image_src( $banner_image, 'full');
    ?>





    <section class="banner-section text-center background-bg" data-image-src="<?php echo $banner_image[0];?>">
        <div class="banner-contents">
            <!-- <img src="images/banner.png" alt="Image"> -->
            <div class="contents-inner">
                <h2 class="text-1"><?php echo $banner_title;?></h2>
                <h2 class="text-2"><?php echo $banner_subtitle;?></h2>
            </div><!-- /.contents-inner -->
        </div><!-- /.banner-contents -->
    </section><!-- /.banner-section -->


    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_banner', 'kc_aa_wp_banner' );


function kc_aa_wp_banner_params() {
    kc_add_map(
        array(

            'aa_wp_banner' => array(
                    "icon" => 'cpicon kc-icon-icarousel',
                    "name" => __("Section: Banner", 'js-essential'),
                    'description' => 'Show Banner Section.',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ),
                    "params" => array(

                        array(
                            'name'          => 'banner_image',
                            'type'          => 'attach_image',
                            'label'         => __( 'Slider Images', 'js-essential' ),
                            'description'   => __( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
                            'admin_label'   => true
                        ),


                        array(
                            'type' => 'text',
                            'label' => __( 'Title', 'js-essential' ),
                            'name' => 'banner_title',
                            'description' => __( 'Enter text used as title of the bar.', 'js-essential' ),
                            'admin_label' => true,
                            'value' => 'We make Minimalism'
                        ),
                        array(
                            'type' => 'text',
                            'label' => __( 'Sub Title', 'js-essential' ),
                            'name' => 'banner_subtitle',
                            'description' => __( 'Enter text used as title of the bar.', 'js-essential' ),
                            'admin_label' => true,
                            'value' => 'the most effective'
                        ),


                    )



                ),  // End of elemnt aa_wp_banner


        )
    );
}

add_action('init', 'kc_aa_wp_banner_params', 99 );

