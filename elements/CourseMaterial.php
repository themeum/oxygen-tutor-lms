<?php
namespace Oxygen\TutorElements;

class CourseMaterial extends \OxygenTutorElements {

	function name() {
        return 'Material';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        tutor_course_material_includes_html();
    }


    function class_names() {
        return array('tutor-course-material', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseMaterial();