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

		$course_benefits = $this->addControlSection("benefits", __("What Will You Learn?"), "assets/icon.png", $this);
		$benefits_selector = $selector." .tutor-course-details-widget";
		$benefits_item_selector = $benefits_selector." .tutor-course-details-widget-list";
        $course_benefits->typographySection(__('Title'), $benefits_selector.' .tutor-course-details-widget-title', $this);
		$course_benefits->typographySection(__('Items Typography'), $benefits_item_selector.' li span', $this);
        $benefits_content_icon = $course_benefits->addControlSection("benefits_content_icon", __("Icon"), "assets/icon.png", $this);
		$benefits_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $benefits_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $benefits_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$benefits_content_spacing = $course_benefits->addControlSection("benefits_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $benefits_content_spacing->addPreset(
            "padding",
            "benefits_content_item_padding",
            __("Items Padding"),
            $benefits_item_selector.' li'
		);
		$benefits_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $benefits_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
    }
}

new CourseBenefits();