<?php

 function kc_aa_wp_contact_details_title( $atts ){

    extract(
        shortcode_atts(
            array(

                    'contact_details'       => 'contact details',
                    'contact_icon'         => esc_html__( 'ti-mobile' ,'jt-essential' ) ,
                    'contact_content'      =>  esc_html__( '121 King Street, Melbourne VIC 3000, Australia', 'jt-essential' )
                ), $atts
            )
        );

    ob_start();
    ?>


             <div class="contact-details">
                <div class="container">
                    <div class="row">
                        <div class="contact-items">

                            <?php foreach ($contact_details as $value) {
                                if( !empty($value->contact_icon) || !empty($value->contact_content)  ){ ?>
                                    <div class="col-sm-4">
                                        <div class="item media">
                                            <div class="item-icon media-left">
                                                <i class="<?php echo esc_attr( $value->contact_icon );?>"></i>
                                            </div><!-- /.item-icon -->
                                            <div class="item-text media-body">
                                                <address>
                                                    <?php echo esc_attr( $value->contact_content );?>
                                                </address>
                                            </div><!-- /.item-text -->
                                        </div><!-- /.item -->
                                    </div>
                            <?php } } ?>

                        </div><!-- /.contact-items -->

                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.contact-details -->

<?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_contact_details', 'kc_aa_wp_contact_details_title' );


function kc_aa_wp_contact_details_title_params() {

    if( function_exists( 'kc_add_icon' ) ) {
        kc_add_icon( get_template_directory_uri().'/assets/css/themify-icons.css' );
    }

    kc_add_map(
        array(

            'aa_wp_contact_details' => array(
                    "icon" => 'fa fa-header',
                    "name" => __("Contact Details", 'jt-essential'),
                    'description' => 'Section Title and Subtitle here.',
                    'category' => 'AA WP',
                    "params" => array(


                        array(
                            'type'          => 'group',
                            'label'         => __(' Contact Details', 'kingcomposer'),
                            'name'          => 'contact_details',
                            'description'   => __( 'Repeat this Icon and Content Field', 'kingcomposer' ),
                            'options'       => array('add_text' => __(' Add New Contact Details', 'kingcomposer')),


                            'value' => base64_encode( json_encode(array(
                                "1" => array(
                                    "label" => "ti-location-pin",
                                    "value" => "121 King Street, Melbourne VIC 3000, Australia"
                                    ),
                                "2" => array(
                                    "label" => "ti-mobile",
                                    "value" => "+61 3 8376 6284 (10 AM - 07 PM)",
                                    ),
                                "3" => array(
                                    "label" => "ti-email",
                                    "value" => "contact-us@aa-wp.com"
                                    )
                                ) ) ),
                            'params' => array(
                                array(
                                    'name'  => 'contact_icon',
                                    'label' => 'Icon',
                                    'type'  => 'icon_picker'
                                ),
                                array(
                                    'name'  => 'contact_content',
                                    'label' => 'Content',
                                    'type'  => 'textarea',
                                    'value'  => esc_html__( '121 King Street, Melbourne VIC 3000, Australia', 'jt-essentials')
                                )
                            ),
                        ),


                    )

                ),  // End of elemnt aa_wp_contact_details_title


        )
    );
}

add_action('init', 'kc_aa_wp_contact_details_title_params', 99 );