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
        tutor_course_target_audience_html();
    }

    function controls() {
        $selector = ".tutor-course-target-audience-wrap";
        $items_selector = $selector." .tutor-course-target-audience-items";

        $this->typographySection(__('Title'), $selector.' > h4.tutor-segment-title');
        $content_section = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
        $content_icon = $content_section->addControlSection("icon", __("Icon"), "assets/icon.png", $this);
        $content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $items_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $items_selector.' li:before',
					"property" => 'color',
				)
			)
        );
        $content_section->typographySection(__('Typography'), $items_selector, $this);
        //spacing
        $content_spacing = $content_section->addControlSection("spacing", __("Spacing"), "assets/icon.png", $this);
        $content_spacing->addPreset(
            "padding",
            "item_padding",
            __("Item Padding"),
            $items_selector.' li'
        );
        $content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $items_selector.' li',
					"property" => 'line-height',
                )
			)
        );
    }
}

new CourseTargetAudience();