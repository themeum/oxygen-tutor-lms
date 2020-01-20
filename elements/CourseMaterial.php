<?php
namespace Oxygen\TutorElements;

class CourseMaterial extends \OxygenTutorElements {

	function name() {
        return 'Material';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        tutor_course_material_includes_html();
    }


    function class_names() {
        return array('tutor-course-material', 'oxy-tutor-element');
    }


    function controls() {
        $selector = ".tutor-course-material-includes-wrap";
        $items_selector = $selector." .tutor-course-target-audience-items";

        $this->typographySection('Title', $selector.' h4.tutor-segment-title');
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

new CourseMaterial();