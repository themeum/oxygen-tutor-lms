<?php
/**
 * Plugin Name: Oxygen Tutor LMS
 * Plugin URI: https://www.themeum.com/product/tutor-lms/
 * Description: Oxygen Builder Integration - Tutor LMS plugin let's you to design your courses, lesson page by Oxygen Builder.
 * Author: Themeum
 * Version: 2.0.4
 * Author URI: http://themeum.com
 * Requires at least: 5.3
 * Tested up to: 7.1.2
 * License: GPLv2 or later
 * Text Domain: oxygen-tutor-lms
 *
 * @package Oxygen Tutor LMS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OTLMS_VERSION', '2.0.4' );
define( 'OTLMS_FILE', __FILE__ );
define( 'OTLMS_PATH', plugin_dir_path( OTLMS_FILE ) );
define( 'OTLMS_URL', plugin_dir_url( OTLMS_FILE ) );

if ( ! class_exists( 'OxygenTutorLMS' ) ) {
	include_once OTLMS_PATH . 'OxygenTutorLMS.php';
}

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once ABSPATH . '/wp-admin/includes/plugin.php';
}

if ( is_plugin_active( 'oxygen/functions.php' ) ) {
	add_filter( 'tutor_lms_should_template_override', '__return_false' );
}

/**
 * Now fire the plugin
 */
add_action( 'plugins_loaded', 'oxygen_tutor_lms_init' );
if ( ! function_exists( 'oxygen_tutor_lms_init' ) ) {
	/**
	 * Initialize the plugin.
	 */
	function oxygen_tutor_lms_init() {
		OxygenTutorLMS::instance();
	}
}

add_action( 'wp_enqueue_scripts', 'tutor_oxygen_lms_assets', 99 );

if ( ! function_exists( 'tutor_oxygen_lms_assets' ) ) {
	/**
	 * Enqueue the plugin's assets.
	 */
	function tutor_oxygen_lms_assets() {
		wp_enqueue_style( 'public-style', plugins_url( 'assets/css/public.css', __FILE__ ), array(), OTLMS_VERSION, 'all' );
	}
}
