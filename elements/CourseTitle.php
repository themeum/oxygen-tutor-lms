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
		return array('tutor-course-title', 'oxy-tutor-element');
	}


	function controls() {

		$this->addStyleControl(
			array(
				"property" => 'font-family',
			)
		);

		$this->addStyleControl(
			array(
				"property" => 'color',
			)
		);

		$this->addStyleControl(
			array(
				"property" => 'font-size',
			)
		);

		$this->addStyleControl(
			array(
				"property" => 'font-weight',
			)
		);

		$this->addTagControl();

	}

}

new CourseTitle();