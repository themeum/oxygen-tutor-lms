<?php
namespace Oxygen\TutorElements;

class CourseAbout extends \OxygenTutorElements {

	function name() {
        return 'About';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/about');
    }

    function class_names() {
        return array('tutor-course-about', 'oxy-tutor-element');
    }

    function controls() {
        $typography_selector = ".tutor-course-summery";
        $this->typographySection('Heading', $typography_selector.' .tutor-segment-title');
        $this->typographySection('Paragraph', $typography_selector);
    }

}

new CourseAbout();