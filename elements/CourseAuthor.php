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
        $img_selector = ".tutor-meta .tutor-avatar";
        $image_section = $this->addControlSection("image", __("Image"), "assets/icon.png", $this);
		$image_section->addStyleControls(
			array(
				array(
                	"name" => __('Height','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'width',
				),
				array(
                	"name" => __('Font Size','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'font-size',
				),
				array(
                	"name" => __('Line Height','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'line-height',
				)
			)
        );

        //section lable and name
        $author_selector = ".tutor-meta";
        $this->typographySection(__('Label','oxygen-tutor-lms'), $author_selector.' span.tutor-mr-16');
        $this->typographySection(__('Name','oxygen-tutor-lms'), $author_selector.' span.tutor-mr-16 a');
    }

}

new CourseAuthor();