<?php
namespace Oxygen\TutorElements;

class CourseRating extends \OxygenTutorElements {

	function name() {
        return 'Rating';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/rating');
    }


    function class_names() {
        return array('tutor-course-rating', 'oxy-tutor-element');
    }


    function controls() {
        
        $star_selector = ".tutor-single-course-rating .tutor-star-rating-group";
        $this->addStyleControls(
			array(
				array(
					"name" 		=> __('Stars Color'),
					"selector" 	=> $star_selector,
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Stars Size'),
					"selector" 	=> $star_selector,
					"property" 	=> 'font-size',
				)
			)
		);
    }

}

new CourseRating();