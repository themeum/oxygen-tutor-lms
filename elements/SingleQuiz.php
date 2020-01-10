<?php
namespace Oxygen\TutorElements;

class SingleQuiz extends \OxygenTutorElements {

	function name() {
		return 'Single Quiz';
	}

	function render($options, $defaults, $content) {
		global $wp_query;
		/**
		 * Start Tutor Template
		 */

		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'tutor_quiz'){
			if (is_user_logged_in()){
				$template = otlms_get_template( 'single-quiz' );
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


new SingleQuiz();