<?php
namespace Oxygen\TutorElements;

class CourseTotalEnrolled extends \OxygenTutorElements {

	function name() {
        return 'Total Enrolled';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/total-enrolled');
    }

    function class_names() {
        return array('tutor-course-total-enrolled', 'oxy-tutor-element');
    }

    function controls() {
        $typography_selector = ".tutor-single-course-meta .tutor-single-course-meta-total-enroll";
        $this->typographySection('Label', $typography_selector.' span');
        $this->typographySection('Value', $typography_selector);
    }

}

new CourseTotalEnrolled();