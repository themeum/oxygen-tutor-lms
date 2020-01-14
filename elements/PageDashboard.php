<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageDashboard extends \OxygenTutorElements {

	function name() {
		return 'Dashboard';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
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