<?php
namespace Oxygen\TutorElements;

class CourseTargetAudience extends \OxygenTutorElements {

	function name() {
        return 'Target Audience';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        echo '<div class="tutor-single-course-sidebar-more course-audience tutor-mt-24">';
            tutor_course_target_audience_html();
        echo '</div>';
    }

    function controls() {
        $selector = ".tutor-single-course-sidebar-more.course-audience";

        $course_target_audience = $this->addControlSection("target_audience", __("Target Audience","oxygen-tutor-lms"), "assets/icon.png", $this);
		$target_audience_selector = $selector." .tutor-course-details-widget";
		$target_audience_item_selector = $target_audience_selector." .tutor-course-details-widget-list";
        $course_target_audience->typographySection('Title', $target_audience_selector.' .tutor-course-details-widget-title', $this);
		$course_target_audience->typographySection(__('List Item','oxygen-tutor-lms'), $target_audience_item_selector, $this);
        $target_audience_content_icon = $course_target_audience->addControlSection("target_audience_content_icon", __("Icon","oxygen-tutor-lms"), "assets/icon.png", $this);
		$target_audience_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size','oxygen-tutor-lms'),
                	"selector" => $target_audience_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color','oxygen-tutor-lms'),
                	"selector" => $target_audience_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
        $course_target_audience->borderSection(__("Borders","oxygen-tutor-lms"), $target_audience_selector, $this);
		$target_audience_content_spacing = $course_target_audience->addControlSection("target_audience_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $target_audience_content_spacing->addPreset(
            "padding",
            "target_audience_content_item_padding",
            __("Items Padding","oxygen-tutor-lms"),
            $target_audience_item_selector.' li'
		);
		$target_audience_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height','oxygen-tutor-lms'),
                	"selector" => $target_audience_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
    }
}

new CourseTargetAudience();