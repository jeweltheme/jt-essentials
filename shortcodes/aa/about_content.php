<?php

 function kc_aa_wp_dropcap_content( $atts ){

    extract(
        shortcode_atts(
            array(
                    'highlight_char'            => 'W',
                    'about_title'               => 'Who we are',
                    'about_content'            => '<strong>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                </strong>
                                <br><br> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste'
                ), $atts
            )
        );
    ob_start();
?>

    <section class="about-we about-we-02 pt-195">
        
            <div class="container">
                <div class="row">
                    <div class="style-03">
                        <div class="col-sm-5">
                            <div class="title-area">
                                <h2 class="section-title"><?php echo esc_attr( $about_title );?></h2>
                                <!-- /.section-ttile -->
                                <span class="section-no"><?php echo esc_attr( $highlight_char );?></span>
                                <!-- /.section-no -->
                            </div>
                            <!-- /.title-area -->
                        </div>

                        <div class="col-sm-7">
                           <p><?php echo $about_content;?></p>
                        </div>
                    </div>
                    <!-- /.section-top -->
                </div>
            </div>
        
    </section>


    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_dropcap_content', 'kc_aa_wp_dropcap_content' );


function kc_aa_wp_dropcap_content_params() {
    kc_add_map(
        array(

            'aa_wp_dropcap_content' => array(
                    "icon" => 'fa fa-user',
                    "name" => esc_html__("Block: About Us", 'js-essential'),
                    'description' => 'Select Images for Clients',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name'          => 'highlight_char',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Highlight Character', 'js-essential' ),
                            'value'         => esc_html__( 'W' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),                        
                        array(
                            'name'          => 'about_title',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Title', 'js-essential' ),                            
                            'value'         => esc_html__( 'Who we are' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),
                        array(
                            'name'          => 'about_content',
                            'type'          => 'editor',
                            'label'         => esc_html__( 'Content', 'js-essential' ),                            
                            'value'         => '<strong>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                </strong>
                                <br><br> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste',
                            'admin_label'   => true,
                        )
                    )



                ),  // End of elemnt aa_wp_dropcap_content


        )
    );
}

add_action('init', 'kc_aa_wp_dropcap_content_params', 99 );

