<?php
/*
Plugin Name: Jewel Theme Essential
Plugin URI: https://github.com/jeweltheme/
Description: Jewel Theme Essential - WordPress Plugin for WordPress Themes
Version: 1.0.0
Author: Jewel Theme
Text Domain: js-essential
Author URI: https://www.jeweltheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'JEWELTHEME_ESSENTIAL_PATH', trailingslashit(plugin_dir_path(__FILE__)) );
define( 'JEWELTHEME_ESSENTIAL_VERSION', '1.0.0');

/**
*
* Custom Post Types
*/
require_once( JEWELTHEME_ESSENTIAL_PATH . '/inc/cpt.php' );

/**
 * Everything else in the framework is conditionally loaded depending on theme options.
 * Let's include all of that now.
 */
require_once( JEWELTHEME_ESSENTIAL_PATH . '/init.php' );
