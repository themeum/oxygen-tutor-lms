<?php
namespace Oxygen\TutorElements;

class SingleLesson extends \OxygenTutorElements {

	function name() {
		return 'Single Lesson';
	}


	function render($options, $defaults, $content) {
		global $wp_query;

		$lesson_post_type = tutor()->lesson_post_type;

		/**
		 * Start Tutor Template
		 */

		$template = '';


		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === $lesson_post_type){
			$page_id = get_the_ID();

			do_action('tutor_lesson_load_before', $template);

			setup_postdata($page_id);

			if (is_user_logged_in()){
				$is_course_enrolled = tutor_utils()->is_course_enrolled_by_lesson();

				if ($is_course_enrolled) {
					$template = otlms_get_template( 'single-lesson' );
				}else{
					//You need to enroll first
					$template = otlms_get_template( 'single-lesson-required-enroll' );

					//Check Lesson edit access to support page builders
					if(current_user_can(tutor()->instructor_role) && tutils()->has_lesson_edit_access()){
						$template = otlms_get_template( 'single-lesson' );
					}
				}
			}else{
				$template = otlms_get_template('login');
			}
			wp_reset_postdata();

			include_once apply_filters('otlms_lesson_template', $template);
		}

		/**
		 * End Tutor Template
		 */
	}


	public function tutor_body_class($classes) {
		$classes[] = 'tutor';
		return $classes;
	}



	public function tutor_button_place() {
		return "single_template";
	}

}


new SingleLesson();