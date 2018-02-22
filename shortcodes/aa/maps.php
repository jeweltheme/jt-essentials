<?php

 function kc_aa_wp_google_maps( $atts ){

    extract(
        shortcode_atts(
            array(
                    'maps_style'        =>  'style1',
                    'map_title'         =>  'Get in touch',
                    'map_section_id'    =>  '04',
                    'lattitude'         =>  '-37.834812',
                    'longitude'         =>  '144.963055',
                ), $atts
            )
        );

    ob_start();
    ?>


<?php if( $maps_style == "style1" ){ ?>

    <section class="contact contact-page">
        <div class="section-padding">
            <div class="container">
                <div class="map-container">
                    <div id="googleMaps" class="googleMaps"></div>
                </div><!-- /.map-container -->
            </div><!-- /.container -->
        </div>
    </section>

<?php } elseif( $maps_style == "style2" ){ ?>

    <div class="contact">
        <div class="map-container">
            <div class="title-area">
                <h2 class="section-title"><?php echo $map_title; ?></h2>
                <span class="section-no"><?php echo $map_section_id; ?></span>
            </div><!-- /.title-area -->
            <div id="googleMaps" class="googleMaps"></div>
        </div><!-- /.map-container -->
    </div>

<?php } ?>


    <?php
        //$google_api_key = $aa_wp_options['google_api_key'];
        wp_enqueue_script( 'google-maps', "//maps.google.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyD2jlT6C_to6X1mMvR9yRWeRvpIgTXgddM", array('jquery'), '', true );

        // add_action('wp_footer', 'aa_wp_maps_script', 100, 2 );
        // function aa_wp_maps_script(){ ?>
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    "use strict";

                        function isMobile() {
                            return ('ontouchstart' in document.documentElement);
                        }
                        function init_gmap() {
                            if ( typeof google == 'undefined' ) return;
                            var options = {
                                center: {lat: <?php echo esc_attr( $lattitude );?> , lng: <?php echo esc_attr( $longitude );?> },
                                zoom: 15,
                                mapTypeControl: true,
                                mapTypeControlOptions: {
                                    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                                },
                                navigationControl: true,
                                scrollwheel: false,
                                streetViewControl: true,
                                styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#faf8f8"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#faf8f8"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#cdcdcd"},{"visibility":"on"}]}]
                            }
                            if (isMobile()) {
                                options.draggable = false;
                            }
                            $('#googleMaps').gmap3({
                                map: {
                                    options: options
                                },
                                <?php if( $maps_style == "style1" ){ ?>
                                    marker: {
                                       latLng: [ <?php echo esc_attr( $lattitude );?>, <?php echo esc_attr( $longitude );?> ],
                                        options: { icon: '<?php echo get_template_directory_uri();?>/images/map-icon.png' }
                                    }
                                <?php } ?>

                            });
                        }

                        init_gmap();

                    });
            </script>
    <?php
    //}


    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_google_maps', 'kc_aa_wp_google_maps' );


function kc_aa_wp_google_maps_params() {
    kc_add_map(
        array(

            'aa_wp_google_maps' => array(
                    "icon" => 'fa fa-map-marker',
                    "name" => __("Block: Google Maps", 'jt-essential'),
                    'description' => 'Google Maps Location',
                    'category' => 'AA WP',
                    "params" => array(
                        array(
                            'name' => 'maps_style',
                            'label' => __( 'Maps Style', 'js-essential' ),
                            'type' => 'select',
                            'value' => 'style1',
                            'options' => array(
                                'style1' => __( 'Style 1', 'js-essential' ),
                                'style2' => __( 'Style 2', 'js-essential' )
                            ),
                        ),

                        array(
                            'name'  => 'map_title',
                            'label' => 'Title',
                            'type'  => 'textfield',
                            'value'  => 'Get in touch',
                            'relation'      => array(
                                'parent'    => 'maps_style',
                                'show_when' => array( 'style2')
                            )
                        ),
                        array(
                            'name'  => 'map_section_id',
                            'label' => 'Section ID',
                            'type'  => 'textfield',
                            'value'  => '04',
                            'relation'      => array(
                                'parent'    => 'maps_style',
                                'show_when' => array( 'style2')
                            )
                        ),


                        array(
                            'name'  => 'lattitude',
                            'label' => 'Lattitude',
                            'type'  => 'textfield',
                            'value'  => '-37.834812',
                        ),

                        array(
                            'name'  => 'longitude',
                            'label' => 'Longitude',
                            'type'  => 'textfield',
                            'value'  => '144.963055',
                        )
                    )

                ),  // End of elemnt aa_wp_google_maps


        )
    );
}

add_action('init', 'kc_aa_wp_google_maps_params', 99 );