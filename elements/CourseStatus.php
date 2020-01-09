<?php
namespace Oxygen\TutorElements;

class CourseStatus extends \OxygenTutorElements {

	function name() {
        return 'Course Status';
    }

    function tutor_button_place() {
        return "single_course";
    }

    /* function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    } */

    function render($options, $defaults, $content) {
        $action = tutils()->array_get('action', $_GET);
        if ($action == 'oxy_render_oxy-course-status') {
           _e('Preview not available', 'oxygen-tutor-lms');
        } else if (is_user_logged_in() && tutils()->is_enrolled()) {
            include_once otlms_get_template('course/status');
        }
    }

    function class_names() {
        return array('tutor-course-status', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseStatus();