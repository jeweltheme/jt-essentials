<?php 


add_action('wp_footer', 'owlfolio_single_thumbanil_overlay', 100);
function owlfolio_single_thumbanil_overlay(){ 
	global $owlfolio_options;
	//if( is_single() || is_page() ){		
	if( is_single() ){		
		$image        = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID(), 'full') );
	?>
	
	<script>
		jQuery(window).load(function() {
	        //BG IMAGES for this page header
	        jQuery(".header-section.single").backstretch([
	        	"<?php echo esc_url_raw( $image );?>"
	        	], {duration: 3000, fade: 750});
	    });
	</script>

<?php } 

	if( is_404()){
	global $owlfolio_options;
	 ?>

	<script>
		jQuery(window).load(function() {			
			//BG IMAGES for this page header
			//$.backstretch([				
			jQuery(".error404").backstretch([
				<?php if( $owlfolio_options[ 'settings_404_bg_image' ]['url'] ){ ?>
					"<?php echo $owlfolio_options[ 'settings_404_bg_image' ]['url']; ?>"
				<?php } else{ ?>
					"<?php echo get_template_directory_uri() . '/images/bg/04.jpg'; ?>"
				<?php }
			?>

			], {duration: 3000, fade: 750});
		});
	</script>

<?php }	



if( $owlfolio_options['coming_soon'] == "enable" ){ ?>
		<script>
			jQuery(window).load(function() {			
				//BG IMAGES for this page header
				//$.backstretch([				
				jQuery(".coming-soon").backstretch([					
						"<?php echo $owlfolio_options[ 'coming_soon_bg_image' ]['url']; ?>"					

				], {duration: 3000, fade: 750});
			});
		</script>
<?php }



}







function owlfolio_custom_styles(){ 
  global $owlfolio_options, $post_id;
?>
  <style type="text/css">

	.action-block-01:hover{
	    background-image: url('<?php echo esc_url_raw( $owlfolio_options[ 'right_action_image' ]['url'] );?>');
	}
	.action-block-02:hover{
	    background-image: url('<?php echo esc_url_raw( $owlfolio_options[ 'left_action_image' ]['url'] );?>');
	}

  </style>
<?php 

}
add_action( 'wp_head', 'owlfolio_custom_styles');
