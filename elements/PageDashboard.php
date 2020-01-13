<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageDashboard extends \OxygenTutorElements {

	function name() {
		return 'Dashboard';
	}

	function render($options, $defaults, $content) {
		/**
		 * Start Tutor Template
		 */

		$shortcode = new Shortcode();
		echo $shortcode->tutor_dashboard();

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "pages";
	}

}


new PageDashboard();