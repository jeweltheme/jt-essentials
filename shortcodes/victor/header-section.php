<?php

 function kc_victor_header_section( $atts,  $content= null ){
 	
 	extract( 
 		shortcode_atts( 
 			array(
	 				'header_style' 		=> 'style1',
	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/06.jpg',
	 				'images' 			=> '',
	 				'headings' 			=> 'designer',
	 				'video_src' 		=> 'Vimeo',
	 				'video_id' 			=> '152596313',
 				), $atts 
 			) 
 		);

	ob_start();	
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');	
?>





<?php if( $header_style == "style1" ){ 

	?>

    <div id="header" class="header-section fullheight">

          <div class="overlay overlay-black">
          </div>

          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center fullheight">
              <div class="valign">
                <h1 class="white font1 font-light"><?php echo htmlspecialchars_decode( $title );?> <span class="white font1 font-bold"><?php echo htmlspecialchars_decode( $subtitle );?></span></h1>
              </div>
            </div>
          </div>

          <div class="floater">
              <a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
          </div>

    </div>

<?php 
} elseif( $header_style == "style2" ){ ?>

    <div id="header" class="header-section fullheight">

          <div class="overlay overlay-black">
          </div>

          <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center fullheight">
              <div class="valign">
                <h2 class="white font1 font-light"><?php echo htmlspecialchars_decode( $title );?> <?php echo htmlspecialchars_decode( $subtitle );?></h2>                
              </div>
            </div>
          </div>

          <div class="floater">
              <a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
          </div>

    </div>


    <div class="carousel-wrapping fullheight">
        <div class="owl-carousel fullheight content-carousel">
        <?php
        $i = 1; 
        $imgs = explode(',', $images);
        if( is_array($imgs) ){
            foreach( $imgs as $ID ){
            	$bg_img = wp_get_attachment_image_src( $ID, 'full');
        ?>
            <div class="content-carousel-item about-carousel-item-0<?php echo $i;?> fullheight" style="background-image: url('<?php echo $bg_img[0];?>');"></div>
        
        <?php $i++; } } ?>

        </div>
    </div>



<?php } elseif( $header_style == "style3" ){ ?>

    <div id="intro" class="intro-section fullheight">

          <div class="overlay overlay-dark">
          </div>

          <div class="row">
            <div class="col-md-12 text-center fullheight intro">
              <div class="valign">
                <!-- <h1 class="black font1">victor</h1> -->
                <div class="tricker">
                  <h2 class="white font1"><?php echo htmlspecialchars_decode( $title );?></h2>
                  <h4 class="white font1"><?php echo htmlspecialchars_decode( $subtitle );?></h4>

                  	<?php foreach ($headings as $value) { 
                  		if( !empty($value->heading) ){ ?>
                  		<h3 class="white font1"><?php echo $value->heading;?></h3>		
                  	<?php } } ?>

                </div>
              </div>
            </div>
          </div>

          <div class="floater">
              <a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
          </div>

    </div>



<?php } elseif( $header_style == "style4" ){ ?>

	<div id="intro" class="intro-section fullheight">

		<div class="overlay overlay-black"></div>

		<div class="row">
			<div class="col-md-12 text-center fullheight intro">
				<div class="valign">
					<!-- <h1 class="black font1">victor</h1> -->
					<div class="tricker">
	                  	<h2 class="white font1"><?php echo htmlspecialchars_decode( $title );?></h2>
	                  	<h4 class="white font1"><?php echo htmlspecialchars_decode( $subtitle );?></h4>
						<?php foreach ($headings as $value) { 
							if( !empty($value->heading) ){ ?>
								<h3 class="white font1"><?php echo $value->heading;?></h3>		
						<?php } } ?>

					</div>
				</div>
			</div>
		</div>

		<div class="floater">
			<a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
		</div>

	</div>


<?php } elseif( $header_style == "style5" ){ ?>

	<div id="header" class="floating-header-section fullheight fullwidth black-bg">

		<div class="carousel-wrapping fullheight">
			<div class="owl-carousel fullheight intro-carousel">

			   	<?php
			        $i = 1; 
			        $imgs = explode(',', $images);
			        if( is_array($imgs) ){
			            foreach( $imgs as $ID ){
			            	$bg_img = wp_get_attachment_image_src( $ID, 'full');
			        ?>			            
			    		<div class="intro-carousel-item intro-carousel-item-0<?php echo $i;?> fullheight" style="background-image: url('<?php echo $bg_img[0];?>');"></div>
			    <?php $i++; } } ?>

			</div>
		</div>

		<div id="floating-ticker" class="floating-ticker-section fullheight">

			<div class="overlay overlay-dark"></div>

			<div class="row">
				<div class="col-md-12 text-center fullheight intro">
					<div class="valign">
						<!-- <h1 class="black font1">victor</h1> -->
						<div class="tricker">		
		                  	<h2 class="white font1"><?php echo htmlspecialchars_decode( $title );?></h2>
		                  	<h4 class="white font1"><?php echo htmlspecialchars_decode( $subtitle );?></h4>							
							<?php foreach ($headings as $value) { 
								if( !empty($value->heading) ){ ?>
								<h3 class="white font1"><?php echo $value->heading;?></h3>		
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>

			<div class="floater">
				<a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
			</div>

		</div>

	</div>



<?php } elseif( $header_style == "style6" ){ ?>



    <div id="intro" class="intro-section fullheight fullwidth">

          <div class="overlay overlay-white"></div>

          <div class="row">
            <div class="col-md-12 text-center fullheight intro">
              <div class="valign">
                <!-- <h1 class="black font1">victor</h1> -->
                <div class="tricker">
                  	<h2 class="white font1"><?php echo htmlspecialchars_decode( $title );?></h2>
                  	<h4 class="white font1"><?php echo htmlspecialchars_decode( $subtitle );?></h4>
					<?php foreach ($headings as $value) { 
						if( !empty($value->heading) ){ ?>
							<h3 class="white font1"><?php echo $value->heading;?></h3>		
					<?php } } ?>
                </div>
              </div>
            </div>
          </div>

          <div class="floater">
              <a class="ease" href="#"><img alt="<?php the_title();?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri();?>/images/arrow.svg"></a>
          </div>

    </div>


<?php } ?>






    <?php 




add_action('wp_footer', 'intro_header_scripts', 100, 2 );


function intro_header_scripts(){
 	
 	extract( 
 		//shortcode_atts( 
 			array(
	 				'header_style' 		=> 'style1',
	 				'title' 			=> 'The Latest',
	 				'subtitle' 			=> 'News &amp; updates',
	 				'bg_image' 			=>  get_template_directory_uri() . '/images/bg/06.jpg',
	 				'images' 			=> '',
	 				'headings' 			=> 'designer',
	 				'video_src' 		=> 'Vimeo',
	 				'video_id' 			=> '152596313',
 				)
 		//	) 
 		);

	ob_start();	
	$bg_image = wp_get_attachment_image_src( $bg_image, 'full');
	?>
	
	<?php if( $header_style == "style1" || $header_style == "style2" ){ ?>
	    <script>
	      jQuery(window).load(function() {
	        	//BG IMAGES for this page header
	          	//jQuery(".header-section, .intro-section").backstretch([
	          	jQuery.backstretch([
	              		"<?php echo $bg_image[0];?>"
	          	], {duration: 3000, fade: 750});
	      	});
	    </script>

	<?php } if( $header_style == "style6" ){ ?>

			<script>

				jQuery(window).load(function() {
		        //BG IMAGES for this page header
		        //jQuery(".intro-section").backstretch([
				jQuery.backstretch([		        	
		        	"<?php echo $bg_image[0];?>"
		        	], {duration: 3000, fade: 750});
		    });

			</script>
	<?php } if( $header_style == "style3" ){ ?>

		<script>
			jQuery(window).load(function() {	        	
	        	//BG IMAGES for this page header
	        	//jQuery(".intro-section").backstretch([
	        	jQuery.backstretch([
				<?php 
					$bg_images = explode(',', $images);
					foreach( $bg_images as $ID ){
						$bg_img = wp_get_attachment_image_src( $ID, 'full');
						if( count($bg_img)>1 ){
							echo "'$bg_img[0]'";
							echo ",";
						}								
					}
				?>
				], {duration: 3000, fade: 750});
	        });
		</script>
	
	<?php } if( $header_style == "style4" ){
		wp_enqueue_style( 'umbg', VICTOR_CSS . "umbg.css" );
		?>		

			<script>

				jQuery(function () {
					//jQuery(window).load(function() {

					if( !device.tablet() && !device.mobile() ) {

						/* plays the BG Vimeo or Youtube video if non-mobile device is detected*/ 
						jQuery('body').umbg({
			              'mediaPlayerType': '<?php echo $video_src;?>', // YouTube, Vimeo, Dailymotion, Wistia, HTML5, Image, or Color.
			              'mediaId': '<?php echo $video_id;?>', // Use the video id . For HTML5 use the location and video filename.
			              'mediaOverlay': 0, //Overlay
			              'displayControls': 0
			          });

					} else {


						/* displays a static image / poster image if mobile device is detected. This is due to limitation of mobile browsers which can not display fullscreen BG videos.*/ 
						jQuery('.intro-section').addClass('poster-img');
						jQuery('.intro-section').find('.overlay').hide();
					}



				});
			
			</script>	


		<?php 

	} ?>
<?php 
}



	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}

add_shortcode( 'victor_header_section', 'kc_victor_header_section' );

 
function kc_victor_header_section_params() {
	kc_add_map(
		array(	
	            
	        'victor_header_section' => array(
	            	'icon' => 'fa-header',
	        		"name" => __("Section: Intro Header", 'js-essential'),
	        		'description' => 'Show Heading Section.',	            	
	            	'category' => 'Victor',
	            	"params" => array(

						array(
							'name' => 'header_style',
							'label' => __( 'Header Style', 'js-essential' ),
							'type' => 'select',
							'value' => 'style1',
		                	'options' => array(
			                		'style1' => __( 'General Header', 'js-essential' ),
			                		'style2' => __( 'About Header', 'js-essential' ),
			                		'style6' => __( 'Ripple Effect (White)', 'js-essential' ),
			                		'style3' => __( 'Ripple Effect & Fullscreen Slider', 'js-essential' ),
			                		'style4' => __( 'Fullscreen Video Background', 'js-essential' ),
			                		'style5' => __( 'Slanted Subtle Carousel', 'js-essential' ),			                		
			                	),
		                ),

	                	array(
	                		'name'  => 'title',
	                		'heading' => 'Title',
	                		'type'  => 'textfield',
	                		'value'  => esc_html__( 'The Latest' ,'js-essential'),
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style1', 'style2', 'style3', 'style4', 'style5', 'style6' )
	                		)
	                	),
	                	array(
	                		'name'  => 'subtitle',
	                		'heading' => 'Sub Title',
	                		'type'  => 'textfield',
	                		'value'  => wp_kses( 'News &amp; updates', 'js-essential' ),
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style1', 'style2', 'style3', 'style4', 'style5', 'style6' )
	                		)
	                	),

						array(
							'type'			=> 'group',
							'label'			=> __(' More Headings', 'kingcomposer'),
							'name'			=> 'headings',
							'description'	=> __( 'Add More Headings to .', 'kingcomposer' ),
							'options'		=> array('add_text' => __(' Add Headings', 'kingcomposer')),
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style3', 'style4', 'style5', 'style6' )
	                		),


							'params' => array(
								array(
									'type' => 'text',
									'label' => __( 'Heading', 'kingcomposer' ),
									'name' => 'heading',									
									'value' =>  esc_html__( 'designer', 'js-essential' ) ,
									'admin_label' => true,
									),
								),
							),



	                	array(
	                		'name' => 'bg_image',
	                		'heading' => esc_html__( 'Upload Image' ,'js-essential'),
	                		'type' => 'attach_image',
	                		'value'	=> get_template_directory_uri() . '/images/bg/06.jpg',
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style1', 'style2', 'style6' )
	                		)
	                	),

						array(
							'name'			=> 'images',
							'type'			=> 'attach_images',
							'label'			=> __( 'Images', 'js-essential' ),							
							'description'	=> __( 'Upload multiple image to the carousel with the SHIFT key holding.', 'js-essential' ),
							'admin_label'	=> true,
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style2', 'style3', 'style5' )
	                		)							
						),


						array(
							'name' => 'video_src',
							'label' => __( 'Video Source', 'js-essential' ),
							'type' => 'select',
							'value' => 'Vimeo',
		                	'options' => array(
			                		'YouTube' => __( 'YouTube', 'js-essential' ),
			                		'Vimeo' => __( 'Vimeo', 'js-essential' ),			                		
			                		'Dailymotion' => __( 'Dailymotion', 'js-essential' ),
			                		'Wistia' => __( 'Wistia', 'js-essential' ),
			                		'HTML5' => __( 'HTML5', 'js-essential' ),
			                	),
		                	'relation'      => array(
		                		'parent'    => 'header_style',
		                		'show_when' => array( 'style4' )
	                		)
		                ),
	                	array(
	                		'name'  => 'video_id',
	                		'heading' => 'Video ID',
	                		'type'  => 'textfield',	
	                		'value' => '152596313',                		
	                		'relation'      => array(
	                			'parent'    => 'header_style',
	                			'show_when' => array( 'style4' )
	                		)
	                	),




	                )

	            ),  // End of elemnt victor_header_section 

	        
		) 
	);
}

add_action('init', 'kc_victor_header_section_params', 99 );



