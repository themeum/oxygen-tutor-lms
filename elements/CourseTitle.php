<?php
namespace Oxygen\TutorElements;

class CourseTitle extends \OxygenTutorElements {

	function name() {
		return 'Title';
	}

	function tag() {
		return $this->headingTagChoices();
	}

	function tutor_button_place() {
		return "single_course";
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		the_title();
	}

	function class_names() {
		return array('oxy-tutor-element', 'oxy-tutor-course-title');
	}

	function controls() {

		$this->addStyleControls(
			array(
				array(
					"property" => 'font-family',
				),
				array(
					"property" => 'color',
				),
				array(
					"property" => 'font-size',
				),
				array(
					"property" => 'font-weight',
				)
			)
		);

		$this->addTagControl();
	}
}

new CourseTitle();