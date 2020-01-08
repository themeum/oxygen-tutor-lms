<?php
namespace Oxygen\TutorElements;

class CoursesList extends \OxygenTutorElements {

	function name() {
		return 'Courses List';
	}


	function render($options, $defaults, $content) {

	    echo 'Course List';
	}

	
	public function controls() {
	    
		/*
		 * Course Query Section
		 */

		$courses_query = $this->addControlSection("courses_query", __('Courses Query', 'oxygen-tutor-lms'), "assets/icon.png", $this);

		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Include ID',
				"slug" => 'id',
			)
		);

		//->setDefaultValue(45)

		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Excludes IDS',
				"slug" => 'include_ids',
			)
		);

		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Category IDS',
				"slug" => 'category',
			)
		);

		$courses_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => 'Order By',
				"slug" => 'orderby',
			)
		)->setValue(array('ID', 'title', 'rand', 'date', 'menu_order', 'post__in'));

		$courses_query->addOptionControl(
			array(
				"type" => 'dropdown',
				"name" => 'Order',
				"slug" => 'order',
			)
		)->setValue(array('DESC', 'ASC'));

		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Limit',
				"slug" => 'limit',
			)
		);

	}

	public function tutor_button_place() {
		return "archive";
	}

}


new CoursesList();