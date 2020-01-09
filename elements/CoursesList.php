<?php
namespace Oxygen\TutorElements;

class CoursesList extends \OxygenTutorElements {

    private $query_params = array(
            'course_id'            => '',
            'exclude_ids'   => '',
            'category'      => '',
            'orderby'       => '',
            'order'         => '',
            'limit'         => '',
    );

	function name() {
		return 'Courses List';
	}


	function render($options, $defaults, $content) {
		$a = tutils()->array_only($options, array_keys($this->query_params));

		$course_post_type = tutor()->course_post_type;

		$default_args = array(
			'post_type'     => $course_post_type,
			'post_status'   => 'publish',
			'course_id'     => '',
			'exclude_ids'   => '',
			'category'      => '',

			'orderby'       => 'ID',
			'order'         => 'DESC',
			'limit'         => '6',
		);

		$a = array_merge($default_args, $a);

		if ( ! empty($a['course_id'])){
			$ids = (array) explode(',', $a['course_id']);
			$a['post__in'] = $ids;
		}

		if ( ! empty($a['exclude_ids'])){
			$exclude_ids = (array) explode(',', $a['exclude_ids']);
			$a['post__not_in'] = $exclude_ids;
		}
		if ( ! empty($a['category'])){
			$category = (array) explode(',', $a['category']);

			$a['tax_query'] = array(
				array(
					'taxonomy' => 'course-category',
					'field'    => 'term_id',
					'terms'    => $category,
					'operator' => 'IN',
				),
			);
		}
		$a['posts_per_page'] = (int) $a['limit'];

		wp_reset_query();
		query_posts($a);
		include_once tutor_get_template('shortcode.tutor-course');
		wp_reset_query();
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
				"slug" => 'course_id',
			)
		);

		//->setDefaultValue(45)

		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Excludes IDS',
				"slug" => 'exclude_ids',
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