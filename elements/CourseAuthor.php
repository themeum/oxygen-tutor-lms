<?php
namespace Oxygen\TutorElements;

class CourseAuthor extends \OxygenTutorElements {

	function name() {
        return 'Author';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/author');
    }


    function class_names() {
        return array('tutor-course-author', 'oxy-tutor-element');
    }


    function controls() {
        //section image
        $image_section = $this->addControlSection("image", __("Image"), "assets/icon.png", $this);
		$image_section->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => ".tutor-single-course-meta ul li .tutor-single-course-avatar span",
					"property" => 'height',
				),
				array(
                	"name" => __('Width'),
                	"selector" => ".tutor-single-course-meta ul li .tutor-single-course-avatar span",
					"property" => 'width',
				),
				array(
                	"name" => __('Font Size'),
                	"selector" => ".tutor-single-course-meta ul li .tutor-single-course-avatar span",
					"property" => 'font-size',
				),
				array(
                	"name" => __('Line Height'),
                	"selector" => ".tutor-single-course-meta ul li .tutor-single-course-avatar span",
					"property" => 'line-height',
				),
				array(
                	"name" => __('Background'),
                	"selector" => ".tutor-single-course-meta ul li .tutor-single-course-avatar span",
					"property" => 'background-color',
				),
			)
        );
        //section lable and name
        $this->typographySection('Label', '.tutor-single-course-author-meta .tutor-single-course-author-name span');
        $this->typographySection('Name', '.tutor-single-course-author-meta .tutor-single-course-author-name a');
    }

}

new CourseAuthor();