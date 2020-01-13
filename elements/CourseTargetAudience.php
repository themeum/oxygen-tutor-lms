<?php
namespace Oxygen\TutorElements;

class CourseTargetAudience extends \OxygenTutorElements {

	function name() {
        return 'Target Audience';
    }

    function tutor_button_place() {
        return "single_course";
    }

    /* function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    } */

    function render($options, $defaults, $content) {
        tutor_course_target_audience_html();
    }


    function class_names() {
        return array('tutor-course-target-audience', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseTargetAudience();