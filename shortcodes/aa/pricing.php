<?php

 function kc_aa_wp_pricing( $atts ){

    extract(
        shortcode_atts(
            array(
                    'ppp'               => '4',
                    'filter'            => 'all',
                ), $atts
            )
        );

    global $post;

    ob_start();
?>


    <section class="pricing-tables gray-bg text-center">
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="tables-area">

                        <?php
                        $query_args = array(
                            'post_type'      => 'pricing',
                            'posts_per_page' => $ppp,
                            'order'          => 'ASC'
                        );
                        $pricing = new WP_Query( $query_args );

                        $j=0;
                        if ( $pricing->have_posts() ) { while ( $pricing->have_posts() ) { $pricing->the_post();

                            $pricing_price          = aa_wp_meta( '_aa_wp_pricing_price' );
                            $pricing_elements       = aa_wp_meta( '_aa_wp_pricing_elements' );
                            $pricing_button         = aa_wp_meta( '_aa_wp_pricing_button' );
                            $pricing_button_link    = aa_wp_meta( '_aa_wp_pricing_button_link' );
                        ?>
                                <div class="col-xs-4">
                                    <div class="pricing-table">
                                        <h3 class="item-title"><?php the_title();?></h3><!-- /.item-title -->
                                        <div class="table-price">
                                            <span class="price"><?php echo esc_attr( $pricing_price );?></span>
                                        </div><!-- /.table-price -->
                                        <ul class="table-details">
                                            <?php
                                            if( $pricing_elements ){
                                                $el_parts = explode("\n", $pricing_elements);
                                                foreach ($el_parts as $el) {
                                                    $el = do_shortcode($el);
                                                    echo "<li>{$el}</li>";
                                                }
                                            }
                                            ?>
                                        </ul><!-- /.table-details -->
                                        <div class="order-area"><a href="<?php echo esc_url( $pricing_button_link );?>" class="btn"><?php echo esc_attr( $pricing_button );?></a></div><!-- /.order-area -->
                                    </div><!-- /.pricing-table -->
                                </div>

                        <?php $j++; wp_reset_postdata(); } } ?>

                    </div><!-- /.tables-area -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.section-padding -->
    </section><!-- /.pricing-tables -->




    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_pricing', 'kc_aa_wp_pricing' );


function kc_aa_wp_pricing_params() {
    kc_add_map(
        array(

            'aa_wp_pricing' => array(
                    "icon" => 'fa fa-quote-left',
                    "name" => esc_html__("Block: Pricing", 'js-essential'),
                    'description' => esc_html__( 'Show Pricing Block.', 'jt-essential' ) ,
                    'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
                    "params" => array(
                        array(
                            'name'  => 'ppp',
                            'label' => esc_html__('Show Pricing Count', 'jt-essential' ),
                            'type'  => 'textfield',
                            'value'  => '4',
                            'description' => esc_html__( 'Set Pricing Posts count. Set -1 to show all items.','jt-essential') ,
                        ),

                    )



                ),  // End of elemnt aa_wp_pricing


        )
    );
}

add_action('init', 'kc_aa_wp_pricing_params', 99 );

