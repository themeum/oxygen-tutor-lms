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
        tutor_course_benefits_html();
    }

    function controls() {
        $selector = ".tutor-course-benefits-wrap";
		$items_selector = $selector." .tutor-course-benefits-items";
        $this->typographySection(__('Title'), $selector.' .course-benefits-title h4', $this);
        $content_section = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
        $content_icon = $content_section->addControlSection("content_icon", __("Icon"), "assets/icon.png", $this);
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
		$content_spacing = $content_section->addControlSection("content_spacing", __("Spacing"), "assets/icon.png", $this);
        $content_spacing->addPreset(
            "padding",
            "content_item_padding",
            __("Items Padding"),
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

new CourseBenefits();