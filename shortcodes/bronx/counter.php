<?php

 function kc_bronx_counter( $atts ){

 	extract(
 		shortcode_atts(
 			array(
	 				
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/04.jpg',
	 				'coutner_part' 			=> 'designer',
 				), $atts
 			)
 		);

	ob_start();
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');
	?>



    <section class="facts fact-07 background-bg" data-image-src="<?php echo esc_url_raw($bg_image[0]);?>">
        <div class="overlay">
            <div class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="countdown">

			            	<?php foreach ($coutner_part as $value) {
			            		if( !empty($value->label) || !empty($value->value)  ){ ?>
		                            
		                            <div class="col-sm-3">
		                                <div class="item">
		                                    <i class="icon icon-user-following"></i><!-- /.fact-icon -->
		                                    <div class="item-details text-left">
		                                        <div class="count-inner">
		                                            <span class="count-number counter">
		                                            	<?php echo $value->value;?>
		                                            </span>
		                                        </div><!-- /.count-inner -->
		                                        <div class="fact-title">
		                                            <?php echo $value->label;?>
		                                        </div><!-- /.fact-title -->
		                                    </div><!-- /.item-details -->
		                                </div><!-- /.fact-item -->
		                            </div><!-- /.col-sm-3 -->

			            	<?php } } ?>

                        </div><!-- /.countdown -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.section-padding -->
        </div>
    </section><!-- /.facts -->





    <?php
    
    


	$output = ob_get_contents();
	ob_end_clean();

	return $output;

}

add_shortcode( 'bronx_counter', 'kc_bronx_counter' );


function kc_bronx_counter_params() {
	
	if( !is_admin()){
		wp_enqueue_style( 'bronx-home-construction',BRONX_CSS . "/home/home-construction.css" );	
	}
	

	kc_add_map(
		array(

	        'bronx_counter' => array(
	            	"icon" => 'cpicon kc-icon-counter',
	        		"name" => __("Section: Counter", 'js-essential'),
	        		'description' => 'Show Counter Section.',
	            	'category' => 'Bronx',
	            	"params" => array(

						array(
							'type'			=> 'group',
							'label'			=> __(' Options', 'js-essential'),
							'name'			=> 'coutner_part',
							'description'	=> __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'js-essential' ),
							'options'		=> array('add_text' => __(' Add New Counter', 'js-essential')),
							

		            		'value' => base64_encode( json_encode(array(
		            			"1" => array(
		            				"label" => "Happy Clients",
		            				"value" => "534"
		            				),		            			
		            			"2" => array(
		            				"label" => "Projects Done",
		            				"value" => "3259"
		            				),
		            			"3" => array(
		            				"label" => "Awesome Staffs",
		            				"value" => "150",
		            				),
		            			"4" => array(
		            				"label" => "Awards won",
		            				"value" => "121"
		            				)
		            			) ) ),
							'params' => array(
								array(
									'type' => 'text',
									'label' => __( 'Counter Title', 'js-essential' ),
									'name' => 'label',
									'description' => __( 'Enter text used as title of the bar.', 'js-essential' ),
									'admin_label' => true,
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

	                	array(
	                		'name' => 'bg_image',
	                		'heading' => esc_html__( 'Upload Image' ,'js-essential'),
	                		'type' => 'attach_image',
	                		'value'	=> get_template_directory_uri() . '/images/bg/04.jpg'
	                	),


	                )



	            ),  // End of elemnt victor_counter


		)
	);
}

add_action('init', 'kc_bronx_counter_params', 99 );

