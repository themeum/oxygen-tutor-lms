<?php
namespace Oxygen\TutorElements;

class SingleAssignment extends \OxygenTutorElements {

	function name() {
		return 'Single Assignments';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		global $wp_query;
		/**
		 * Start Tutor Template
		 */

		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'tutor_assignments'){
			if (is_user_logged_in()){
				$template = otlms_get_template( 'single-assignment' );
			}else{
				$template = otlms_get_template('login');
			}
			include_once $template;
		}

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "single_template";
	}

}


new SingleAssignment();