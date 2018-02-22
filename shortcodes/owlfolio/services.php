<?php

 function kc_owlfolio_sevices( $atts ){

 	extract(
 		shortcode_atts(
 			array(
	 				'service_title' 		=>  esc_html__( 'What We do', 'jt-essential' ),
	 				'service_content' 		=>  esc_html__( 'We focused on emotional connection to build commerce with culture and business through the brand. The process focused on winning together by working together.', 'jt-essential' ),
	 				'service_icon' 			=>  'ti-ruler-pencil',
	 				'service_options' 		=>  '',
 				), $atts
 			)
 		);

	ob_start();

	?>


		<div class="about-items">

          	<?php foreach ($service_options as $value) { ?>
		            <div class="item col-sm-4 media">
		                <div class="item-icon media-left"><i class="<?php echo $value->service_icon;?>"></i></div><!-- /.item-icon -->
		                <div class="item-details media-body">
		                    <h3 class="item-title"><?php echo $value->service_title;?></h3><!-- /.item-title -->
		                    <p>
		                        <?php echo $value->service_content;?>
		                    </p>
		                </div><!-- /.item-details -->
		            </div><!-- /.item -->
          	<?php } ?>

         </div>

<?php

	$output = ob_get_contents();

	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_sevices', 'kc_owlfolio_sevices' );


function kc_owlfolio_sevices_params() {

	if( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( get_template_directory_uri().'/assets/css/themify-icons.css' );
	}

	kc_add_map(
		array(

		'owlfolio_sevices' => array(
			'name' => esc_html__('Block: Service', 'jt-essential'),
			'category' => esc_html__( 'Owlfolio', 'jt-essential' ) ,
			'icon' => 'kc-icon-accordion',
			'title' => esc_html__('Service Settings', 'jt-essential'),
			'params' => array(


				array(
					'type'			=> 'group',
					'label'			=> __('Our Services', 'jt-essential'),
					'name'			=> 'service_options',
					'description'	=> __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'jt-essential' ),
					'options'		=> array('add_text' => __('Add new Service', 'jt-essential')),
					'value' => base64_encode( json_encode(array(
						"1" => array(
								"service_title" 	=> "Design",
								"service_content" 	=> "‘Experience Design’ or UX/UI is a design strategy, focused on the emotional connection between a brand’s offer and the people who use it.",
								"service_icon"		=> "ti-ruler-pencil",
							),
						"2" => array(
								"service_title" 	=> "Development",
								"service_content" 	=> "Planning to Development isn't so easy. Always listen to the audience before develop a project. We implement the easy function to for them.",
								"service_icon"		=> "ti-layout",
							),
						"3" => array(
								"service_title" 	=> "Branding",
								"service_content" 	=> " We drive commerce through brand culture and an understanding of user behavior. You got inspiration to invest in what a brand stands for.",
								"service_icon"		=> "ti-paint-bucket",
							)
						) ) ),

					'params' => array(
							array(
								'name' => 'service_title',
								'label' => esc_html__('Service Title', 'jt-essential'),
								'type' => 'text',
								'value' => esc_html__('What We do', 'jt-essential')
							),
							array(
								'name' => 'service_content',
								'label' => esc_html__('Service Content', 'jt-essential'),
								'type' => 'text',
								'value' => esc_html__('We focused on emotional connection to build commerce with culture and business through the brand. The process focused on winning together by working together.', 'jt-essential')
							),
							array(
								'name' => 'service_icon',
								'label' => esc_html__('Service Icon', 'jt-essential'),
								'type' => 'icon_picker'
							)

						),
					),




				),
			),



		)
	);
}

add_action('init', 'kc_owlfolio_sevices_params', 99 );