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
        echo '<div class="tutor-single-course-sidebar-more tutor-mt-24">';
            tutor_course_material_includes_html();
        echo '</div>';
    }

    function controls() {
        $selector = ".tutor-single-course-sidebar-more";

        $course_materials = $this->addControlSection("materials", __("Materials"), "assets/icon.png", $this);
		$materials_selector = $selector." .tutor-single-course-sidebar-more .tutor-course-details-widget";
		$materials_item_selector = $materials_selector." .tutor-course-details-widget-list";
        $course_materials->typographySection(__('Title'), $materials_selector.' .tutor-course-details-widget-title', $this);
		$course_materials->typographySection(__('List Item'), $materials_item_selector, $this);
        $materials_content_icon = $course_materials->addControlSection("materials_content_icon", __("Icon"), "assets/icon.png", $this);
		$materials_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $materials_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $materials_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$materials_content_spacing = $course_materials->addControlSection("materials_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $materials_content_spacing->addPreset(
            "padding",
            "materials_content_item_padding",
            __("Items Padding"),
            $materials_item_selector.' li'
		);
		$materials_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $materials_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
    }
}

new CourseMaterial();