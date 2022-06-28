<?php
namespace Oxygen\TutorElements;

class CourseInstructors extends \OxygenTutorElements {

	function name() {
        return 'Instructors';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/instructor');
    }

    function controls() {
        $selector = ".tutor-single-course-sidebar-more";
        
        $course_instructors = $this->addControlSection("instructors", __("Instructors"), "assets/icon.png", $this);
		$instructors_selector = $selector." .tutor-course-details-instructors";
        $course_instructors->borderSection(__("Borders"), $instructors_selector, $this);
        $course_instructors->typographySection(__('Title'), $instructors_selector.' h3', $this);
        $instructors_img_selector = $instructors_selector." .tutor-avatar";
        $img_section = $course_instructors->addControlSection("instructors_image", __("Image"), "assets/icon.png", $this);
        $img_section->addStyleControls(
            array(
                array(
                    "name" => __('Height'),
                    "selector" => $instructors_img_selector,
                    "property" => 'height',
                ),
                array(
                    "name" => __('Width'),
                    "selector" => $instructors_img_selector,
                    "property" => 'width',
                ),
                array(
                    "name" => __('Font Size'),
                    "selector" => $instructors_img_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __('Line Height'),
                    "selector" => $instructors_img_selector,
                    "property" => 'line-height',
                )
            )
        );
        $instructors_name_selector = $instructors_selector." a";
        $instructors_designation_selector = $instructors_selector." .tutor-instructor-designation";
        $course_instructors->typographySection(__("Name"), $instructors_name_selector, $this);
        $course_instructors->typographySection(__("Designation"), $instructors_designation_selector, $this);
    }
}

new CourseInstructors();