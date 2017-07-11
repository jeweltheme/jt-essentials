<?php

 function kc_victor_counter( $atts ){
 	
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





<?php if( $counter_style == "style1" ){ ?>

 
    <div class="highlights-section pad-top pad-bottom overlay-black">
      <div class="container">
            <div class="row add-top add-bottom">
            	
            	<?php 
            	foreach ($coutner_part as $value) { 
            		if( !empty($value->label) || !empty($value->value)  ){ ?>            		
	            		<div class="col-md-4 text-center intro">
	            			<h1 class="white font1 font-bold count-number"><?php echo $value->value;?></h1>
	            			<h3 class="white font1 font-light"><?php echo $value->label;?></h3>
	            		</div>
            	<?php } } ?>

            </div>
      </div>
    </div>


<?php } elseif( $counter_style == "style2" ){ ?>

    <div class="highlights-section pad-top pad-bottom white-bg">
      <div class="container">
            <div class="row add-top add-bottom">
                
                <?php foreach ($coutner_part as $value) { 
            		if( !empty($value->label) || !empty($value->value)  ){ ?>            		

	            		<div class="col-md-4 text-center intro">
	            			<h1 class="black font1 font-bold count-number"><?php echo $value->value;?></h1>
	            			<h3 class="grey font1 font-light"><?php echo $value->label;?></h3>
	            		</div>

            	<?php } } ?>

            </div>
      </div>
    </div>

<?php } ?>


<?php if( $counter_style == "style1" ){ ?>
	    <script>
	      jQuery(window).load(function() {
	        //BG IMAGES for this page header
	          jQuery(".highlights-section").backstretch([	          		
	              		"<?php echo $bg_image[0];?>"						
	          ], {duration: 3000, fade: 750});
	      });
	    </script>
<?php } ?>


    <?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_counter', 'kc_victor_counter' );

 
function kc_victor_counter_params() {
	kc_add_map(
		array(	
	            
	        'victor_counter' => array(
	            	"icon" => 'fa fa-clock-o',
	        		"name" => __("Section: Counter", 'js-essential'),
	        		'description' => 'Show Counter Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(


						array(
								'name' => 'counter_style',
								'label' => __( 'Header Style', 'js-essential' ),
								'type' => 'select',
								'value' => 'middle',
			                	'options' => array(
				                		'style1' => __( 'With Background', 'js-essential' ),
				                		'style2' => __( 'No Background', 'js-essential' ),
				                	),
			            ),

						array(
							'type'			=> 'group',
							'label'			=> __(' Options', 'kingcomposer'),
							'name'			=> 'coutner_part',
							'description'	=> __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'kingcomposer' ),
							'options'		=> array('add_text' => __(' Add new progress bar', 'kingcomposer')),
							'relation'      => array(
								'parent'    => 'counter_style',
								'show_when' => array( 'style1', 'style2' )
							),

		            		'value' => base64_encode( json_encode(array(
		            			"1" => array(
		            				"label" => "Years of Experience",
		            				"value" => "12"
		            				),
		            			"2" => array(
		            				"label" => "Projects Completed",
		            				"value" => "297",
		            				),
		            			"3" => array(
		            				"label" => "Awards &amp; Mentions",
		            				"value" => "34"
		            				)
		            			) ) ),
							'params' => array(
								array(
									'type' => 'text',
									'label' => __( 'Counter Title', 'kingcomposer' ),
									'name' => 'label',
									'description' => __( 'Enter text used as title of the bar.', 'kingcomposer' ),
									'admin_label' => true,
								),
								array(
									'type' => 'text',
									'label' => __( 'Counter Value', 'kingcomposer' ),
									'name' => 'value',
									'description' => __( 'Enter targeted value of the bar (From 1 to 100).', 'kingcomposer' ),
									'admin_label' => true,
									'value' => '80'
								),

							),
						),			            

	                	array(
	                		'name' => 'bg_image',
	                		'heading' => esc_html__( 'Upload Image' ,'js-essential'),
	                		'type' => 'attach_image',
	                		'value'	=> get_template_directory_uri() . '/images/bg/04.jpg',
	                		'relation'      => array(
	                			'parent'    => 'counter_style',
	                			'show_when' => array( 'style1' )
	                		)
	                	),







	                )
	                


	            ),  // End of elemnt victor_counter 

	        
		) 
	);
}

add_action('init', 'kc_victor_counter_params', 99 );

