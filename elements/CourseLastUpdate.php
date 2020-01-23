<?php
namespace Oxygen\TutorElements;

class CourseLastUpdate extends \OxygenTutorElements {

	function name() {
        return 'Last Update';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        $disable_update_date = get_tutor_option('disable_course_update_date');
        if(!$disable_update_date) {
            $markup = '';
            $markup .= "<div class='tutor-single-course-meta-last-update'>";
            $markup .= esc_html(get_the_modified_date());
            $markup .= "</div>";
            echo $markup;
        }
    }

    function controls() {
        $this->typographySection('Typography', '.tutor-single-course-meta-last-update');
    }

}

new CourseLastUpdate();