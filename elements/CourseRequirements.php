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
        tutor_course_requirements_html();
    }


    function class_names() {
        return array('tutor-course-requirements', 'oxy-tutor-element');
    }


    function controls() {
        $selector = ".tutor-course-requirements-wrap";
        $items_selector = $selector." .tutor-course-requirements-items";

        $this->typographySection('Title', $selector.' .course-requirements-title h4');
        $content_section = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
        $content_icon = $content_section->addControlSection("icon", __("Icon"), "assets/icon.png", $this);
        $content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Font Size'),
                	"selector" => $items_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Font Color'),
                	"selector" => $items_selector.' li:before',
					"property" => 'color',
				)
			)
        );
        $content_section->typographySection('Typography', $items_selector, $this);
        //spacing
        $content_spacing = $content_section->addControlSection("spacing", __("Spacing"), "assets/icon.png", $this);
        $content_spacing->addPreset(
            "padding",
            "item_padding",
            __("Item Paddings"),
            $items_selector.' li'
        );
    }

}

new CourseRequirements();