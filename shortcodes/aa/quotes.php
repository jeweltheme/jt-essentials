<?php

 function kc_aa_wp_quote( $atts ){

    extract(
        shortcode_atts(
            array(
                    'quote_title'           => 'Ask for a Free Quote',
                    'quote_desc'            => 'Duis aute irure dolor in eprehenderit in voluptate velit esse cillum dolore eu fugiat nulla ariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
                    'quote_link_text'       => 'Contact Us',
                    'quote_link'            => '#'
                ), $atts
            )
        );
    ob_start();
?>

    <section class="ask-quote gray-bg text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="quote-contents">
                        <h3 class="item-title"><?php echo esc_attr( $quote_title );?></h3><!-- /.item-title -->
                        <p><?php echo esc_attr( $quote_desc );?></p>
                        <div class="btn-container"><a href="<?php echo esc_attr( $quote_link );?>" class="btn"><?php echo esc_attr( $quote_link_text );?></a></div><!-- /.btn-container -->
                    </div><!-- /.quote-contents -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.ask-quote -->




    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_quote', 'kc_aa_wp_quote' );


function kc_aa_wp_quote_params() {
    kc_add_map(
        array(

            'aa_wp_quote' => array(
                    "icon" => 'fa fa-user',
                    "name" => esc_html__("Block: Quotes", 'js-essential'),
                    'description' => 'Select Images for Clients',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name'          => 'quote_title',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Title', 'js-essential' ),                            
                            'value'         => esc_html__( 'Ask for a Free Quote' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),
                        array(
                            'name'          => 'quote_desc',
                            'type'          => 'textarea',
                            'label'         => esc_html__( 'Content', 'js-essential' ),                            
                            'value'         => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum CONTACT US' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),
                        array(
                            'name'          => 'quote_link_text',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Link Text','js-essential' ),    
                            'value'         => esc_html__( 'Contact Us' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),                        
                        array(
                            'name'          => 'quote_link',
                            'type'          => 'textfield',
                            'label'         => esc_html__( 'Link','js-essential' ),    
                            'value'         => esc_html__( '#' , 'jt-essential' ) ,
                            'admin_label'   => true,
                        ),                        

                    )



                ),  // End of elemnt aa_wp_quote


        )
    );
}

add_action('init', 'kc_aa_wp_quote_params', 99 );

