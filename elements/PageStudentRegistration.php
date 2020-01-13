<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageStudentRegistration extends \OxygenTutorElements {

	function name() {
		return 'Student Registration';
	}

	function render($options, $defaults, $content) {
		/**
		 * Start Tutor Template
		 */

		$shortcode = new Shortcode();
		echo $shortcode->student_registration_form();

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "pages";
	}

}


new PageStudentRegistration();