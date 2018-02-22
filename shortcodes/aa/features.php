<?php

 function kc_aa_wp_features( $atts ){

    extract(
        shortcode_atts(
            array(
                    'features_style'             => 'style1',
                    'feature_icon'               => 'ti-ruler-pencil',
                    'feature_title'              => 'Design',
                    'features_part'              => 'Design',
                    'feature_content'            => 'Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.'
                ), $atts
            )
        );
    ob_start();
?>

    <div class="container">
        <div class="row">

            <?php if( $features_style == "style1" ){ ?>

                <div class="features section-details top-127">

                    <?php foreach ($features_part as $value) { ?>

                            <div class="col-xs-6">
                                <div class="item media">
                                    <div class="item-icon media-left">
                                        <i class="<?php echo $value->feature_icon;?>"></i>
                                    </div>
                                    <!-- /.item-icon -->
                                    <div class="item-details media-body">
                                        <h3 class="item-title"><?php echo $value->feature_title;?></h3>
                                        <p>
                                            <?php echo $value->feature_content;?>
                                        </p>
                                    </div>
                                    <!-- /.item-details -->
                                </div>
                                <!-- /.item -->
                            </div>

                    <?php } ?>

                </div>
                <!-- /.section-details -->

            <?php } elseif( $features_style == "style2" ){ ?>

                    <div class="section-details top-96 bottom-127">

                        <?php
                        $i=1;
                        foreach ($features_part as $value) { ?>

                            <div class="col-sm-6">
                                <div class="item media">
                                    <div class="item-left media-left">
                                        <div class="title-area title-area-02">
                                            <h2 class="item-title"><?php echo $value->feature_title;?></h2>
                                            <span class="item-no">
                                                <?php
                                                if ($i < 10) {
                                                    echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                } ?>
                                            </span>
                                        </div>
                                        <!-- /.title-area -->
                                    </div>
                                    <!-- /.item-left -->
                                    <div class="item-details media-body">
                                        <p>
                                            <?php echo $value->feature_content;?>
                                        </p>
                                    </div>
                                    <!-- /.item-details -->
                                </div>
                                <!-- /.item -->
                            </div>

                        <?php
                        $i++;
                    } ?>

                    </div>

            <?php } elseif( $features_style == "style3" ){ ?>

                <div class="objectives top-127 bottom-127">
                    <div class="section-details">

                        <?php foreach ($features_part as $value) { ?>
                            <div class="col-sm-4 col-xs-6">
                                <div class="item media">
                                    <div class="item-icon media-left"><i class="<?php echo $value->feature_icon;?>"></i></div>
                                    <!-- /.item-icon -->
                                    <div class="item-details media-body">
                                        <h3 class="item-title"><?php echo $value->feature_title;?></h3>
                                        <!-- /.item-title -->
                                        <p>
                                            <?php echo $value->feature_content;?>
                                        </p>
                                    </div>
                                    <!-- /.item-details -->
                                </div>
                                <!-- /.item -->
                            </div>
                        <?php } ?>

                    </div>
                </div>

            <?php } elseif( $features_style == "style4" ){ ?>

                <div class="services">
                    <div class="mb-143">
                        <div class="services-items style-02">

                            <?php $i = 1;
                            foreach ($features_part as $value) { ?>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="item media">
                                        <div class="item-icon media-left"><i class="<?php echo $value->feature_icon;?>"></i></div><!-- /.item-icon -->
                                        <div class="item-details media-body">
                                            <span class="item-number">
                                                <?php if ($i < 10) {
                                                        echo str_pad($i, 2, "0", STR_PAD_LEFT);
                                                } ?>
                                            </span><!-- /.item-number -->
                                            <h3 class="item-title"><?php echo $value->feature_title;?></h3><!-- /.item-title -->
                                        </div><!-- /.item-details -->
                                    </div><!-- /.item -->
                                </div>
                            <?php $i++; } ?>

                        </div><!-- /.services-items -->
                    </div><!-- /.section-bottom -->
                </div><!-- /.services -->

            <?php } ?>


        </div>
    </div>


    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'aa_wp_features', 'kc_aa_wp_features' );


function kc_aa_wp_features_params() {
    kc_add_map(
        array(

            'aa_wp_features' => array(
                    "icon" => 'fa fa-user',
                    "name" => esc_html__("Block: Features", 'js-essential'),
                    'description' => 'Select Images for Clients',
                    'category' => esc_html__( 'AA WP', 'jt-essential' ),
                    "params" => array(

                        array(
                            'name' => 'features_style',
                            'label' => __( 'Feature Style', 'js-essential' ),
                            'type' => 'select',
                            'value' => 'style1',
                            'options' => array(
                                'style1' => __( 'Style 1', 'js-essential' ),
                                'style2' => __( 'Style 2', 'js-essential' ),
                                'style3' => __( 'Style 3', 'js-essential' ),
                                'style4' => __( 'Style 4', 'js-essential' ),
                            ),
                        ),
                        array(
                            'type'          => 'group',
                            'label'         => __(' Options', 'js-essential'),
                            'name'          => 'features_part',
                            'description'   => __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'js-essential' ),
                            'options'       => array('add_text' => __(' Add New Feature', 'js-essential')),
                            'relation'      => array(
                                'parent'    => 'features_style',
                                'show_when' => array( 'style1', 'style2', 'style3', 'style4' )
                            ),

                            // 'value' => base64_encode( json_encode(array(
                            //     "1" => array(
                            //         "label" => "Icon",
                            //         "value" => "ti-ruler-pencil"
                            //         ),
                            //     "2" => array(
                            //         "label" => "Title",
                            //         "value" => "DESIGN",
                            //         ),
                            //     "3" => array(
                            //         "label" => "Feature Description",
                            //         "value" => "Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio."
                            //         )
                            //     ) ) ),
                            'params' => array(
                                array(
                                    'name'          => 'feature_icon',
                                    'label'         => 'Icon',
                                    'type'          => 'icon_picker',
                                    'value'          => 'ti-palette',
                                    'admin_label'   => true,
                                    // 'parent'    => 'features_part',
                                    // 'show_when' => array( 'style1' )

                                ),
                                array(
                                    'name'          => 'feature_title',
                                    'type'          => 'textfield',
                                    'label'         => esc_html__( 'Title', 'js-essential' ),
                                    'value'         => esc_html__( 'DESIGN' , 'jt-essential' ) ,
                                    'admin_label'   => true,
                                ),
                                array(
                                    'name'          => 'feature_content',
                                    'type'          => 'textarea',
                                    'label'         => esc_html__( 'Content', 'js-essential' ),
                                    'value'         => 'Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.',
                                    'admin_label'   => true,
                                )

                            ),
                        ),


                    )



                ),  // End of elemnt aa_wp_features


        )
    );
}

add_action('init', 'kc_aa_wp_features_params', 99 );

