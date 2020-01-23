<?php
namespace Oxygen\TutorElements;

class CourseDuration extends \OxygenTutorElements {

	function name() {
        return 'Duration';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        $course_duration = get_tutor_course_duration_context();
        $disable_course_duration = get_tutor_option('disable_course_duration');
        if( !empty($course_duration) && !$disable_course_duration) {
            $markup = '';
            $markup .= "<div class='tutor-single-course-meta-duration'>";
            $markup .= $course_duration;
            $markup .= "</div>";
            echo $markup;
        }
    }

    function controls() {
        $this->typographySection('Typography', '.tutor-single-course-meta-duration');
    }

}

new CourseDuration();