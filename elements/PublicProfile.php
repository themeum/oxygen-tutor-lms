<?php
namespace Oxygen\TutorElements;

class PublicProfile extends \OxygenTutorElements {

	function name() {
		return 'User Public Profile';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		global $wp_query;
		/**
		 * Start Tutor Template
		 */

		if ( ! empty($wp_query->query['tutor_student_username'])){
			$template = otlms_get_template( 'public-profile' );
			include_once $template;
		}else {
			$builder_element = sanitize_text_field(tutils()->array_get('action', $_GET));
			if ($builder_element === 'oxy_render_oxy-user-public-profile'){
				echo '<h3>Public profile preview is not available</h3>';
			}
		}

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "single_template";
	}
}

new PublicProfile();