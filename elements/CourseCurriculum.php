<?php
namespace Oxygen\TutorElements;

class CourseCurriculum extends \OxygenTutorElements {

	function name() {
        return 'Curriculum';
    }

    function tutor_button_place() {
        return "single_course";
    }

    /* function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    } */

    function render($options, $defaults, $content) {
        tutor_course_topics();
    }


    function class_names() {
        return array('tutor-course-curriculum', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseCurriculum();