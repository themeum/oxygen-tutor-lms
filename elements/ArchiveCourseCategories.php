<?php
namespace Oxygen\TutorElements;

class ArchiveCourseCategories extends \OxygenTutorElements {

	function name() {
		return 'Archive Categories';
	}

	function render($options, $defaults, $content) {
		$course_post_type = tutor()->course_post_type;

		global $wp_query;
		/**
		 * Start Tutor Template
		 */

		$post_type = get_query_var('post_type');
		$course_category = get_query_var('course-category');

		if ( ($post_type === $course_post_type || ! empty($course_category) )  && $wp_query->is_archive){
			$template = otlms_get_template('archive-course');
			include_once $template;
		}

		/**
		 * End Tutor Template
		 */
	}


	public function tutor_body_class($classes) {
		$classes[] = 'tutor';
		$classes[] = 'courses-archive';
		return $classes;
	}



	public function tutor_button_place() {
		return "archive";
	}

}


new ArchiveCourseCategories();