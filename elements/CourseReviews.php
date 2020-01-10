<?php
namespace Oxygen\TutorElements;

class CourseReviews extends \OxygenTutorElements {

	function name() {
        return 'Course Reviews';
    }

    function tutor_button_place() {
        return "single_course";
    }

    /* function icon() {
        return plugin_dir_url(__FILE__) . 'assets/'.basename(__FILE__, '.php').'.svg';
    } */

    function render($options, $defaults, $content) {
        tutor_course_target_reviews_html();
    }


    function class_names() {
        return array('tutor-course-reviews', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseReviews();