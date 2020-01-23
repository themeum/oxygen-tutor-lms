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
        $disable_total_enrolled = get_tutor_option('disable_course_total_enrolled');
        if(!$disable_total_enrolled) {
            $markup = '';
            $markup .= "<div class='tutor-single-course-meta-total-enroll'>";
            $markup .= (int) tutor_utils()->count_enrolled_users_by_course();
            $markup .= "</div>";
            echo $markup;
        }
    }

    function controls() {
        $this->typographySection('Typography', '.tutor-single-course-meta-total-enroll');
    }

}

new CourseTotalEnrolled();