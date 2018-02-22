<?php

 function kc_aa_wp_client_logos( $atts ){

    extract(
        shortcode_atts(
            array(
                    'client_logos'      => '',
                    'client_title'      => 'Happy Client',
                    'client_logo_style' => 'style1'
                ), $atts
            )
        );
    ob_start();
?>

    <?php if( $client_logo_style == "style1" ){ ?>
            <div class="section-bottom">
                <div class="client-logos text-center">
                    <div class="logos">
                        <?php
                        $i = 1;
                        $imgs = explode(',', $client_logos);
                        if( is_array($imgs) ){
                            foreach( $imgs as $ID ){
                                $bg_img = wp_get_attachment_image_src( $ID, 'full');
                            ?>
                            <div class="col-xs-3">
                                <div class="item">
                                    <a href="<?php echo esc_url_raw( get_post_meta( $ID, "_client_url", true ) );?>" target="_blank">
                                        <img src="<?php echo $bg_img[0];?>" alt="<?php the_title_attribute();?>">
                                    </a>
                                </div>
                            </div>
                        <?php $i++; } } ?>

                    </div><!-- /.logos -->
                </div><!-- /.client-logos -->
            </div><!-- /.section-bottom -->


    <?php } elseif( $client_logo_style == "style2" ){ ?>

        <div class="section-bottom top-127">
            <div class="client-logos has-title text-center">
                <h2 class="item-title"><?php echo $client_title;?></h2>
                <div class="logos">

                    <?php
                        $i = 1;
                        $imgs = explode(',', $client_logos);
                        if( is_array($imgs) ){
                            foreach( $imgs as $ID ){
                                $bg_img = wp_get_attachment_image_src( $ID, 'full');
                            ?>
                            <div class="col-xs-3">
                                <div class="item">
                                    <a href="<?php echo esc_url_raw( get_post_meta( $ID, "_client_url", true ) );?>" target="_blank">
                                        <img src="<?php echo $bg_img[0];?>" alt="<?php the_title_attribute();?>">
                                    </a>
                                </div>
                            </div>
                    <?php $i++; } } ?>
                </div><!-- /.logos -->
            </div><!-- /.client-logos -->
        </div>

    <?php } ?>


    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_client_logos', 'kc_aa_wp_client_logos' );


function kc_aa_wp_client_logos_params() {
    kc_add_map(
        array(

            'aa_wp_client_logos' => array(
                    "icon" => 'fa fa-user',
                    "name" => esc_html__("Block: Client Logos", 'js-essential'),
                    'description' => 'Select Images for Clients',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name' => 'client_logo_style',
                            'label' => __( 'Client Logo Style', 'js-essential' ),
                            'type' => 'select',
                            'value' => 'style1',
                            'options' => array(
                                'style1' => __( 'Style 1', 'js-essential' ),
                                'style2' => __( 'Style 2', 'js-essential' )
                            ),
                        ),
                        array(
                            'name'          => 'client_title',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Title', 'js-essential' ),
                            'value'         => esc_html__( 'Happy Client' , 'jt-essential' ) ,
                            'admin_label'   => true,
                            'relation'      => array(
                                'parent'    => 'client_logo_style',
                                'show_when' => array( 'style2' )
                            ),

                        ),
                        array(
                            'name'          => 'client_logos',
                            'type'          => 'attach_images',
                            'label'         => esc_html__( 'Client Logos', 'js-essential' ),
                            'description'   => esc_html__( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
                            'admin_label'   => true,
                        ),



                    )



                ),  // End of elemnt aa_wp_client_logos


        )
    );
}

add_action('init', 'kc_aa_wp_client_logos_params', 99 );

