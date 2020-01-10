<?php
namespace Oxygen\TutorElements;

class SingleCourse extends \OxygenTutorElements {

	function name() {
		return 'Single Course';
	}


	function render($options, $defaults, $content) {
		$course_post_type = tutor()->course_post_type;

		global $wp_query;
		/**
		 * Start Tutor Template
		 */

		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === $course_post_type){
			$student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');
			if ($student_must_login_to_view_course){
				if ( ! is_user_logged_in() ) {
					$template = otlms_get_template( 'login' );
					include_once $template;
					return;
				}
			}

			wp_reset_query();
			if (empty( $wp_query->query_vars['course_subpage'])) {
				$template = otlms_get_template( 'single-course' );
				if ( is_user_logged_in() ) {
					if ( tutor_utils()->is_enrolled() ) {
						$template = otlms_get_template( 'single-course-enrolled' );
					}
				}
			}else{
				//If Course Subpage Exists
				if ( is_user_logged_in() ) {
					$course_subpage = $wp_query->query_vars['course_subpage'];
					$template = otlms_get_template( 'single-course-enrolled-' . $course_subpage );
					if ( ! file_exists( $template ) ) {
						$template = otlms_get_template( 'single-course-enrolled-subpage' );
					}
				}else{
					$template = otlms_get_template('login');
				}
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


new SingleCourse();