<?php
/*
Plugin Name: Oxygen Tutor LMS
Plugin URI: https://www.themeum.com/product/tutor-lms/
Description: Oxygen Builder Integration - Tutor LMS plugin let's you to design your courses, lesson page by Oxygen Builder.
Author: Themeum
Version: 1.0.0
Author URI: http://themeum.com
Requires at least: 4.5
Tested up to: 5.3
License: GPLv2 or later
Text Domain: oxygen-tutor-lms
*/
if ( ! defined( 'ABSPATH' ) )
	exit;

define('OTLMS_VERSION', '1.0.0');
define('OTLMS_FILE', __FILE__);
define('OTLMS_PATH', plugin_dir_path(OTLMS_FILE));
define('OTLMS_URL', plugin_dir_url(OTLMS_FILE));

if ( ! class_exists('OxygenTutorLMS')){
	include_once OTLMS_PATH.'OxygenTutorLMS.php';
}

/**
 * Turn off template override from TutorLMS
 */
add_filter('tutor_lms_should_template_override', '__return_false');

/**
 * Now fire the plugin
 * ekhon plugin-e agun lagiye den
 */
add_action('plugins_loaded', 'oxygen_tutor_lms_init');
function oxygen_tutor_lms_init(){
	OxygenTutorLMS::instance();
}