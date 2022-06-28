<?php
namespace Oxygen\TutorElements;

class CourseBenefits extends \OxygenTutorElements {

	function name() {
        return 'Benefits';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
		echo '<div class="tutor-course-benefits">';
        	tutor_course_benefits_html();
		echo '</div>';
    }

    function controls() {
        $selector = ".tutor-course-benefits";

		
    }
}

new CourseBenefits();