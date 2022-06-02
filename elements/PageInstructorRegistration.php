<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageInstructorRegistration extends \OxygenTutorElements {

	function name() {
		return 'Instructor Registration';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		/**
		 * Start Tutor Template
		 */

		$shortcode = new Shortcode();
		echo $shortcode->instructor_registration_form();

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "pages";
	}

}


new PageInstructorRegistration();