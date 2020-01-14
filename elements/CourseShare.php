<?php
namespace Oxygen\TutorElements;

class CourseShare extends \OxygenTutorElements {

	function name() {
        return 'Share';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/share');
    }


    function class_names() {
        return array('tutor-course-share', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseShare();