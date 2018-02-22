<?php

 function kc_aa_wp_skills( $atts ){

 	extract(
 		shortcode_atts(
 			array(

	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/04.jpg',
	 				'skills_part' 			=> 'designer',
 				), $atts
 			)
 		);

	ob_start();
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');
	?>

    <section class="our-skills top-127 bottom-195">

            <div class="container">
                <div class="row">

                    <div class="section-details">

						<?php foreach ($skills_part as $value) {
			            		if( !empty($value->label) || !empty($value->value)  ){ ?>

	                        <div class="col-sm-3 col-xs-6">
	                            <div class="item">
	                                <div class="chart" data-percent="77" data-parcent-color="red" data-scale-color="#fff">
	                                    <div class="chart-content">
	                                        <?php echo $value->value;?>%
	                                    </div>
	                                    <!-- /.chart-content -->
	                                </div>
	                                <!-- /.chart -->

	                                <div class="item-details">
	                                    <h3 class="item-title"><?php echo $value->label;?></h3>
	                                    <!-- /.item-title -->
	                                    <p>
	                                        <?php echo $value->desc;?>
	                                    </p>
	                                </div>
	                                <!-- /.item-details -->
	                            </div>
	                            <!-- /.item -->
	                        </div>

						<?php } } ?>


                    </div>
                    <!-- /.section-details -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->


    </section>
    <!-- /.our-skills -->




    <?php

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'aa_wp_skills', 'kc_aa_wp_skills' );


function kc_aa_wp_skills_params() {
	kc_add_map(
		array(

	        'aa_wp_skills' => array(
	            	"icon" => 'fa fa-clock-o',
	        		"name" => __("Section: Skills", 'js-essential'),
	        		'description' => 'Show Skills Section.',
	            	'category' => esc_html__( 'AA WP', 'jt-essential' ),
	            	"params" => array(

						array(
							'type'			=> 'group',
							'label'			=> __(' Options', 'js-essential'),
							'name'			=> 'skills_part',
							'description'	=> __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'js-essential' ),
							'options'		=> array('add_text' => __(' Add New Skill', 'js-essential')),

		            		'value' => base64_encode( json_encode(array(
		            			"1" => array(
		            				"label" => "Photoshop",
		            				"value" => "70",
		            				"desc" => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu",
		            			),
		            			"2" => array(
		            				"label" => "HTML &amp; CSS",
		            				"value" => "81",
		            				"desc" => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu",
		            			),
		            			"3" => array(
		            				"label" => "WordPress",
		            				"value" => "90",
		            				"desc" => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu",
		            			),
		            			"4" => array(
		            				"label" => "WooCommerce",
			            			"value" => "90",
			            			"desc" => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu",
		            			)

		            			) ) ),
							'params' => array(
								array(
									'type' => 'text',
									'label' => __( 'Skill Title', 'js-essential' ),
									'name' => 'label',
									'description' => __( 'Enter text used as title of the bar.', 'js-essential' ),
									'admin_label' => true,
									'value' => 'Photoshop'
								),
								array(
									'type' => 'text',
									'label' => __( 'Skill Value', 'js-essential' ),
									'name' => 'value',
									'description' => __( 'Enter targeted value of the bar (From 1 to 100).', 'js-essential' ),
									'admin_label' => true,
									'value' => '70'
								),
								array(
									'type' => 'textarea',
									'label' => __( 'Skill Description', 'js-essential' ),
									'name' => 'desc',
									'admin_label' => true,
									'value' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu'
								),


							),
						),


	                )



	            ),  // End of elemnt aa_wp_skills


		)
	);
}

add_action('init', 'kc_aa_wp_skills_params', 99 );

