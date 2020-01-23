<?php
namespace Oxygen\TutorElements;

class CourseShare extends \OxygenTutorElements {

	function name() {
        return 'Share';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/share');
    }


    function class_names() {
        return array('tutor-course-share', 'oxy-tutor-element');
    }


    function controls() {
        $typography_selector = ".tutor-single-course-meta .tutor-social-share";
        $layout_section = $this->addControlSection("layout", __("Layout"), "assets/icon.png", $this);
        $items_align = $layout_section->addControl("buttons-list", "items_align", __("Items Align") );
        $items_align->setValue(array(
            "left"		=> "Left",
            "right"    => "Right" 
        ));
        $items_align->setValueCSS( array(
            "left" => "$typography_selector {
                float: left;
            }",
            "right" => "$typography_selector {
                float: right;
            }"
        ));

        $this->typographySection('Label', $typography_selector.' span');
        $this->typographySection('Original Icons', $typography_selector.' .tutor-social-share-wrap button');
        $this->typographySection('Hovered Icons', $typography_selector.' .tutor-social-share-wrap button:hover');
    }

}

new CourseShare();