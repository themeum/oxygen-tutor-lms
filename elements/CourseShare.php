<?php
namespace Oxygen\TutorElements;

class CourseShare extends \OxygenTutorElements {

	function name() {
        return 'Social Share';
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
        $typography_selector = ".tutor-course-details-actions";
        $layout_section = $this->addControlSection("layout", __("Social Share","oxygen-tutor-lms"), "assets/icon.png", $this);

        $this->typographySection(__('Label','oxygen-tutor-lms'), $typography_selector.' a');
        $this->typographySection(__('Original Icons','oxygen-tutor-lms'), $typography_selector.' a i, a span');
        $this->typographySection(__('Hovered Icons','oxygen-tutor-lms'), $typography_selector.' .tutor-social-share-wrap a:hover');
    }

}

new CourseShare();