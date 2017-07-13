<?php

 function kc_owlfolio_section_title( $atts ){
 	
 	extract( 
 		shortcode_atts( 
 			array(	 				
	 				'section_title_style' 	=> 'style1',
	 				'section_title' 		=> esc_html__( 'Get In Touch' ,'jt-essential' ) ,
	 				'sesction_content' 		=>  esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error', 'jt-essential' )
 				), $atts 
 			) 
 		);

	ob_start();	
	?>

	<?php if( $section_title_style == "style1" ){ ?>

		<div class="section-title-area-03">
			<h2 class="section-title"><?php echo htmlspecialchars_decode( $section_title );?></h2>
			<p>
				<?php echo htmlspecialchars_decode( $sesction_content );?>
			</p>
		</div>

	<?php } elseif( $section_title_style == "style2" ){ ?>	

        <div class="section-title-area">
            <h2><?php echo htmlspecialchars_decode( $section_title );?> </h2>
            <h2><?php echo htmlspecialchars_decode( $sesction_content );?></h2>
        </div><!-- /.section-title-area -->


	<?php } elseif( $section_title_style == "style3" ){ ?>

        <div class="section-title-area section-title-area-02">
        	<div class="col-md-offset-6 col-sm-offset-5">
        		<h2><?php echo htmlspecialchars_decode( $section_title );?> </h2>
        		<h2><?php echo htmlspecialchars_decode( $sesction_content );?></h2>
        	</div>
        </div><!-- /.section-title-area -->

   	<?php } ?>



<?php 

	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'owlfolio_section_title', 'kc_owlfolio_section_title' );

 
function kc_owlfolio_section_title_params() {
	kc_add_map(
		array(	
	            
	        'owlfolio_section_title' => array(
	            	"icon" => 'fa fa-header',
	        		"name" => __("Block: Section Title", 'jt-essential'),
	        		'description' => 'Section Title and Subtitle here.',	            	
	            	'category' => 'Owlfolio',
	            	"params" => array(
	            		array(
	            			'name' => 'section_title_style',
	            			'label' => esc_html__( 'Section Title Style', 'jt-essential' ),
	            			'type' => 'select',
	            			'value' => 'style1',
	            			'options' => array(
	            				'style1' => esc_html__( 'Standard', 'jt-essential' ),
	            				'style2' => esc_html__( 'Left Align', 'jt-essential' ),	            				
	            				'style3' => esc_html__( 'Right Align', 'jt-essential' ),	            				
	            			),
	            		),
	                	array(
	                		'name'  => 'section_title',
	                		'label' => 'Title',
	                		'type'  => 'textfield',
	                		'value'  => esc_html__( 'Get In Touch' , 'jt-essential' ) ,
	                	),

	                	array(
	                		'name'  => 'sesction_content',
	                		'label' => 'Content',
	                		'type'  => 'textarea',
	                		'value'  => esc_html__( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error', 'jt-essentials') ,
	                	)
	                )

	            ),  // End of elemnt owlfolio_section_title 

	        
		) 
	);
}

add_action('init', 'kc_owlfolio_section_title_params', 99 );