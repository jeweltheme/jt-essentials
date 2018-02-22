<?php

 function kc_aa_wp_section_title( $atts ){

    extract(
        shortcode_atts(
            array(
                    'section_title_style'           => 'style1',
                    'section_title'                 => esc_html__( 'Get In Touch' ,'jt-essential' ) ,
                    'section_highlight_character'   => esc_html__( 'G' ,'jt-essential' )
                ), $atts
            )
        );

    ob_start();
?>

        <div class="contact section-top">
            <div class="title-area style-02">
                <h2 class="section-title"><span><?php echo htmlspecialchars_decode( $section_title );?></span></h2>
                <span class="section-no"><?php echo htmlspecialchars_decode( $section_highlight_character );?></span>
            </div><!-- /.title-area -->
        </div>

<?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode( 'aa_wp_section_title', 'kc_aa_wp_section_title' );


function kc_aa_wp_section_title_params() {
    kc_add_map(
        array(

            'aa_wp_section_title' => array(
                    "icon" => 'fa fa-header',
                    "name" => __("Block: Section Title", 'jt-essential'),
                    'description' => 'Section Title and Subtitle here.',
                    'category' => 'AA WP',
                    "params" => array(
                        array(
                            'name'  => 'section_title',
                            'label' => 'Title',
                            'type'  => 'textfield',
                            'value'  => esc_html__( 'Get in touch' , 'jt-essential' ) ,
                        ),
                        array(
                            'name'  => 'section_highlight_character',
                            'label' => 'Highlight Character',
                            'type'  => 'textfield',
                            'value'  => esc_html__( 'G' , 'jt-essential' ) ,
                        ),

                    )

                ),  // End of elemnt aa_wp_section_title


        )
    );
}

add_action('init', 'kc_aa_wp_section_title_params', 99 );