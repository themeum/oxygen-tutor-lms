<?php
namespace Oxygen\TutorElements;

class CourseEnrolmentBox extends \OxygenTutorElements {

	function name() {
        return 'Enrolment Box';
    }

    function tutor_button_place() {
        return "single_course";
    }

    /* function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    } */

    function render($options, $defaults, $content) {
        
        if (is_user_logged_in() && tutils()->is_enrolled()) {
            include_once otlms_get_template('course/enrolled-box');
        } else {
            include_once otlms_get_template('course/enrolment-box');
        }
    }

    function class_names() {
        return array('tutor-course-enrolment-box', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseEnrolmentBox();