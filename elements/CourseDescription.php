<?php
namespace Oxygen\TutorElements;

class CourseDescription extends \OxygenTutorElements {

	function name() {
		return 'Description';
	}

	function tutor_button_place() {
		return "single_course";
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		include_once otlms_get_template('course/content');
	}

	function class_names() {
		return array('tutor-course-description', 'oxy-tutor-element');
	}

	function controls() {

		$selector = '.tutor-course-details-page';
	}

}

new CourseDescription();