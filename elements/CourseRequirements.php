<?php
namespace Oxygen\TutorElements;

class CourseRequirements extends \OxygenTutorElements {

	function name() {
        return 'Requirements';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        echo '<div class="tutor-single-course-sidebar-more course-requirements tutor-mt-24">';
            include_once otlms_get_template('course/course-requirements');
        echo '</div>';
    }

    function controls() {
        $selector = ".tutor-single-course-sidebar-more.course-requirements";

        $course_requirements = $this->addControlSection("requirements", __("Requirements","oxygen-tutor-lms"), "assets/icon.png", $this);
		$requirements_selector = $selector." .tutor-course-details-widget";
		$requirements_item_selector = $requirements_selector." .tutor-course-details-widget-list";
        $course_requirements->typographySection('Title', $requirements_selector.' .tutor-course-details-widget-title', $this);
		$course_requirements->typographySection(__('List Item','oxygen-tutor-lms'), $requirements_item_selector, $this);
        $requirements_content_icon = $course_requirements->addControlSection("requirements_content_icon", __("Icon"), "assets/icon.png", $this);
		$requirements_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size','oxygen-tutor-lms'),
                	"selector" => $requirements_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color','oxygen-tutor-lms'),
                	"selector" => $requirements_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
        $course_requirements->borderSection(__("Borders","oxygen-tutor-lms"), $requirements_selector, $this);
		$requirements_content_spacing = $course_requirements->addControlSection("requirements_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $requirements_content_spacing->addPreset(
            "padding",
            "requirements_content_item_padding",
            __("Items Padding","oxygen-tutor-lms"),
            $requirements_item_selector.' li'
		);
		$requirements_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height','oxygen-tutor-lms'),
                	"selector" => $requirements_item_selector.' li',
					"property" => 'line-height',
                )
			)
		);
    }

}

new CourseRequirements();