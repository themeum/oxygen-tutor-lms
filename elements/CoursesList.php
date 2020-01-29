<?php
namespace Oxygen\TutorElements;

class CoursesList extends \OxygenTutorElements {

    private $query_params = array(
            'course_id'     => '',
            'exclude_ids'   => '',
            'category'      => '',
            'orderby'       => '',
            'order'         => '',
            'limit'         => '',
    );

	function name() {
		return 'Courses List';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
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

	public function tutor_button_place() {
		return "archive";
	}
	
	public function controls() {
		/* Course Query Section */
		$courses_query = $this->addControlSection("courses_query", __('Courses Query', 'oxygen-tutor-lms'), "assets/icon.png", $this);
		$courses_query->addOptionControl(
			array(
				"type" => 'textfield',
				"name" => 'Include ID',
				"slug" => 'course_id',
			)
		);
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

		/* Courses style */
		$selector = '.tutor-courses-loop-wrap';
		$course_grid = $this->addControlSection("course_grid", __("Courses Style"), "assets/icon.png", $this);
		$course_col_selector = $selector.' .tutor-course-col-3';
		$course_grid_selector = $course_col_selector.' .tutor-course';

		/* level bagde */
		$level_badge = $course_grid->addControlSection("level_badge", __("Level Badge"), "assets/icon.png", $this);
		$level_badge_selector = $course_grid_selector." .tutor-course-loop-header-meta .tutor-course-loop-level";
		$level_badge->addStyleControls(
			array(
				array(
					"selector" => $level_badge_selector,
					"property" => 'background-color',
				),
				array(
					"selector" => $level_badge_selector,
					"property" => 'font-size',
				),
				array(
					"selector" => $level_badge_selector,
					"property" => 'font-family',
				),
				array(
					"selector" => $level_badge_selector,
					"property" => 'line-height',
				),
				array(
					"selector" => $level_badge_selector,
					"property" => 'border-radius',
				),
				array(
					"selector" => $level_badge_selector,
					"property" => 'text-transform',
				)
			)
		);

		/* wishlist icon */
		$wishlist_icon = $course_grid->addControlSection("wishlist_icon", __("Wishlist Icon"), "assets/icon.png", $this);
		$wishlist_icon_selector = $course_grid_selector." .tutor-course-loop-header-meta .tutor-course-wishlist";
		$wishlist_icon->addStyleControls(
			array(
				array(
					"name" 		=> __('Font Size'),
					"selector" 	=> $wishlist_icon_selector.' a',
					"property" 	=> 'font-size',
				),
				array(
					"name" 		=> __('Font Color'),
					"selector" 	=> $wishlist_icon_selector.' a',
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Hover Font Color'),
					"selector" 	=> $wishlist_icon_selector.' a:hover',
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Background Color'),
					"selector" 	=> $wishlist_icon_selector,
					"property" 	=> 'background-color',
				),
				array(
					"name" 		=> __('Hover Background Color'),
					"selector" 	=> $wishlist_icon_selector.':hover',
					"property" 	=> 'background-color',
				)
			)
		);

		$loop_course_container = $course_grid_selector.' .tutor-loop-course-container';

		/* Stars */
		$stars_section = $course_grid->addControlSection("stars", __("Stars"), "assets/icon.png", $this);
		$star_selector = $loop_course_container." .tutor-loop-rating-wrap .tutor-star-rating-group";
        $stars_section->addStyleControls(
        	array(
        		array(
					"name" 		=> __('Color'),
					"selector" 	=> $star_selector,
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Size'),
					"selector" 	=> $star_selector,
					"property" 	=> 'font-size',
				)
        	)
		);
		
		$course_grid->typographySection(__("Course Title"), $loop_course_container.' .tutor-course-loop-title h2 a', $this);
		$course_grid->typographySection(__("Meta Info"), $loop_course_container.' .tutor-course-loop-meta', $this);
		$course_grid->typographySection(__("Author Label"), $loop_course_container.' .tutor-single-course-author-name span, '.$loop_course_container.' .tutor-course-lising-category span', $this);
		$course_grid->typographySection(__("Author Value"), $loop_course_container.' .tutor-single-course-author-name a, '.$loop_course_container.' .tutor-course-lising-category a', $this);
		
		$loop_course_container_footer = $course_grid_selector.' .tutor-loop-course-footer';
		$course_grid->typographySection(__("Course Price"), $loop_course_container_footer.' .price, '.$loop_course_container_footer.' .price .woocommerce-Price-amount', $this);
		$course_grid->typographySection(__("Cart Button"), $loop_course_container_footer.' .tutor-loop-cart-btn-wrap a', $this);

		$course_grid->boxShadowSection(__("Box Shadow"), $course_grid_selector, $this);
		$course_grid->boxShadowSection(__("Hover Box Shadow"), $course_grid_selector.":hover", $this);
	}
}

new CoursesList();