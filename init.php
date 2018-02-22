<?php

$defaults = array(
	'portfolio_post_type'    => '0',
	'pricing_post_type'    	 => '0',
	'team_post_type'         => '0',
	'client_post_type'       => '0',
	'events_post_type'       => '0',
	'service_post_type'      => '0',
	'testimonial_post_type'  => '0',
	'faq_post_type'          => '0',

	//Metaboxes
	'rwmbmetabox'            => '0',

	//Demo Importer
	'demo_importer'          => '0',

	// Victor
	'victor_shortcode_blocks' => '0',
	'victor_shortcodes' 	  => '0',

	// Owlfolio
	'owlfolio_shortcode_blocks' => '0',
	'owlfolio_shortcodes' 	  	=> '0',

	// AA WP
	'aa_shortcode_blocks' 	=> '0',
	'aa_shortcodes' 	  	=> '0',

);

$jeweltheme_options = wp_parse_args( get_option('jeweltheme_options'), $defaults);




/**
 * Register Post Types
 */
if( '1' == $jeweltheme_options['portfolio_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_portfolio', 10 );
	add_action( 'init', 'jeweltheme_essentials_create_portfolio_taxonomies', 10  );
}

if( '1' == $jeweltheme_options['pricing_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_pricing', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_pricing_taxonomies', 10  );
}


if( '1' == $jeweltheme_options['team_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_team', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_team_taxonomies', 10  );
}

if( '1' == $jeweltheme_options['client_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_client', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_client_taxonomies', 10  );
}

if( '1' == $jeweltheme_options['events_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_events', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_events_taxonomies', 10  );
}

if( '1' == $jeweltheme_options['service_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_services', 10  );
}

if( '1' == $jeweltheme_options['testimonial_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_testimonial', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_testimonial_taxonomies', 10  );
}

if( '1' == $jeweltheme_options['faq_post_type'] ){
	add_action( 'init', 'jeweltheme_essentials_register_faq', 10  );
	add_action( 'init', 'jeweltheme_essentials_create_faq_taxonomies', 10  );
}


if( '1' == $jeweltheme_options['demo_importer'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'inc/demo-importer/one-click-demo-import.php' );
}

if( '1' == $jeweltheme_options['victor_shortcodes'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'themes/victor.php' );
}

if( '1' == $jeweltheme_options['owlfolio_shortcodes'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'themes/owlfolio.php' );
}

if( '1' == $jeweltheme_options['aa_shortcodes'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'themes/aa-wp.php' );
}

/*
* RWMB Metabox
* @author http://www.deluxeblogtips.com/meta-box
*/
if( '1' == $jeweltheme_options['rwmbmetabox'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'meta-box/meta-box.php' );
}



/*===================================================================================
 * Custom Posts Query with Sorting Order
 * =================================================================================*/
function js_essential_get_custom_posts($type, $limit = 20, $order = "DESC"){
    wp_reset_postdata();
    $args = array(
        "posts_per_page" 	=> $limit,
        "post_type" 		=> $type,
        'orderby' 			=> 'menu_order',
        "order" 			=> $order,
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}


// Victor Shortcodes
if( '1' == $jeweltheme_options['victor_shortcode_blocks'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/header-section.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/work.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/counter.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/carousel.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/promo.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/about_content.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/victor/blog.php' );
}


// Owlfolio Shortcodes
if( '1' == $jeweltheme_options['owlfolio_shortcode_blocks'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/section-title.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/maps.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/animated-text.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/services.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/team.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/client-logos.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/portfolio.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/testimonial.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/owlfolio/blog.php' );
}

// AA WP Shortcodes
if( '1' == $jeweltheme_options['aa_shortcode_blocks'] ){
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/section-title.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/maps.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/contact-details.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/pricing.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/quotes.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/about_content.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/features.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/counter.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/skills.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/banner.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/blog.php' );

	// require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/animated-text.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/services.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/team.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/client-logos.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/portfolio.php' );
	require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/testimonial.php' );
	// require_once( JEWELTHEME_ESSENTIAL_PATH . 'shortcodes/aa/blog.php' );
}
