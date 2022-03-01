<?php
/**
 * OWM Widget
 *
 * Frontend weather widget addon for the OWM Weather plugin.
 *
 * @package     OWM_Widget
 * @link        https://github.com/ControlledChaos/owm-widget
 *
 * Plugin Name:  OWM Widget
 * Plugin URI:   https://github.com/ControlledChaos/owm-widget
 * Description:  Frontend weather widget addon for the OWM Weather plugin.
 * Version:      1.0.0
 * Author:       Controlled Chaos Design
 * Author URI:   http://ccdzine.com/
 * Text Domain:  owm-widget
 * Domain Path:  /languages
 * Requires PHP: 5.3
 * Requires at least: 4.7
 * Tested up to: 5.9.1
 */

namespace OWM_Widget;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Constant: Plugin base name
 *
 * @since 1.0.0
 * @var   string The base name of this plugin file.
 */
define( 'OWMW_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Constant: Plugin folder path
 *
 * @since 1.0.0
 * @var   string The filesystem directory path (with trailing slash)
 *               for the plugin __FILE__ passed in.
 */
if ( ! defined( 'OWMW_PATH' ) ) {
	define( 'OWMW_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 */
if ( ! function_exists( 'is_plugin_active' ) ) {
	require( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// Load required files.
foreach ( glob( OWMW_PATH . '/includes/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( OWMW_PATH . '/includes/classes/*.php' ) as $filename ) {
	require $filename;
}

/**
 * OWM Weather required
 *
 * Add admin notice and stop here if the OWM Weather plugin is not active.
 */
if ( ! is_plugin_active( 'owm-weather/owmweather.php' ) ) {
	Activate\row_notice();
	return;
}

// Register the weather shortcode widget.
add_action( 'widgets_init', function() {
	register_widget( 'OWM_Widget\Classes\Weather_Shortcode_Widget' );
} );
