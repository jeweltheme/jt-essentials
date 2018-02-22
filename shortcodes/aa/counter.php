<?php

 function kc_aa_wp_counter( $atts ){

 	extract(
 		shortcode_atts(
 			array(
	 				'counter_style' 		=> 'style1',
	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/04.jpg',
	 				'coutner_part' 			=> 'designer',
 				), $atts
 			)
 		);

	ob_start();
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');
	?>


	<section class="about-us gray-bg">
		<div class="container">
			<div class="row">
				<div class="section-padding">
        			<div class="section-bottom">
						<?php foreach ($coutner_part as $value) {
			            		if( !empty($value->label) || !empty($value->value)  ){ ?>

							        <div class="col-sm-3 col-xs-6">
							            <div class="item media">
							                <div class="count-area media-left">
							                    <span class="counter"><?php echo $value->value;?></span>
							                    <!-- /.counter -->
							                </div>
							                <!-- /.count-area -->
							                <h3 class="item-title media-body"><?php echo $value->label;?></h3>
							                <!-- /.item-title -->
							            </div>
							            <!-- /.item -->
							        </div>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
    </section>


    <?php

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'aa_wp_counter', 'kc_aa_wp_counter' );


function kc_aa_wp_counter_params() {
	kc_add_map(
		array(

	        'aa_wp_counter' => array(
	            	"icon" => 'fa fa-clock-o',
	        		"name" => __("Section: Counter", 'js-essential'),
	        		'description' => 'Show Counter Section.',
	            	'category' => esc_html__( 'AA WP', 'jt-essential' ) ,
	            	"params" => array(

						array(
							'type'			=> 'group',
							'label'			=> __(' Options', 'js-essential'),
							'name'			=> 'coutner_part',
							'description'	=> __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'js-essential' ),
							'options'		=> array('add_text' => __(' Add New Counter', 'js-essential')),

		            		'value' => base64_encode( json_encode(array(
		            			"1" => array(
		            				"label" => "Projects Done",
		            				"value" => "212"
		            				),
		            			"2" => array(
		            				"label" => "Happy clients",
		            				"value" => "545",
		            				),
		            			"3" => array(
		            				"label" => "Cups of tea taken",
		            				"value" => "1100"
		            				),
		            			"4" => array(
		            				"label" => "Awards won",
		            				"value" => "101"
		            				)

		            			) ) ),
							'params' => array(
								array(
									'type' => 'text',
									'label' => __( 'Counter Title', 'js-essential' ),
									'name' => 'label',
									'description' => __( 'Enter text used as title of the bar.', 'js-essential' ),
									'admin_label' => true,
									'value' => 'Projects Done'
								),
								array(
									'type' => 'text',
									'label' => __( 'Counter Value', 'js-essential' ),
									'name' => 'value',
									'description' => __( 'Enter targeted value of the bar (From 1 to 100).', 'js-essential' ),
									'admin_label' => true,
									'value' => '80'
								),

							),
						),


	                )



	            ),  // End of elemnt aa_wp_counter


		)
	);
}

add_action('init', 'kc_aa_wp_counter_params', 99 );

