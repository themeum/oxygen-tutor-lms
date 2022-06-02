<?php
namespace Oxygen\TutorElements;

class ArchiveCourse extends \OxygenTutorElements {

	function name() {
		return 'Archive Courses';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		$course_post_type = tutor()->course_post_type;

		global $wp_query;
		/**
		 * Start Tutor Template
		 */
		$post_type = get_query_var('post_type');
		$course_category = get_query_var('course-category');
		if ( ($post_type === $course_post_type || ! empty($course_category) )  && $wp_query->is_archive){
			$template = otlms_get_template('archive-course');
			include_once $template;
		}
		/**
		 * End Tutor Template
		 */
	}

	function tutor_button_place() {
		return "archive";
	}

	function controls() {
		$selector = '.tutor-courses-wrap';
		/* Filter section */
		$filter_selector = $selector.' .tutor-course-filter-container';

		$sorting_select = $this->addControlSection("sorting_select", __("Course Filter"), "assets/icon.png", $this);
        $sorting_select_selector = $filter_selector.' .tutor-course-filter .tutor-widget';
        $sorting_select->typographySection(__("Filter Widget Title"), $sorting_select_selector . ' .tutor-widget-title ', $this);
        $sorting_select->typographySection(__("Filter Items"), $sorting_select_selector . ' .tutor-list-item label ', $this);

		/* Course grid */
		$course_col_selector = $selector.' .tutor-course-list';
		$course_grid_selector = $course_col_selector.' .tutor-course-card';
		$course_grid = $this->addControlSection("course_grid", __("Course Grid"), "assets/icon.png", $this);

		/* wishlist icon */
		$wishlist_icon = $course_grid->addControlSection("wishlist_icon", __("Wishlist Icon"), "assets/icon.png", $this);
		$wishlist_icon_selector = $course_grid_selector." .tutor-course-bookmark .tutor-iconic-btn-secondary";
		$wishlist_icon->addStyleControls(
			array(
				array(
					"name" 		=> __('Font Size'),
					"selector" 	=> $wishlist_icon_selector.'i',
					"property" 	=> 'font-size',
				),
				array(
					"name" 		=> __('Font Color'),
					"selector" 	=> $wishlist_icon_selector.' i',
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Hover Font Color'),
					"selector" 	=> $wishlist_icon_selector.':hover i',
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

		$loop_course_container = $course_grid_selector.' .tutor-card-body';

		/* Stars */
		$stars_section = $course_grid->addControlSection("stars", __("Course Ratings"), "assets/icon.png", $this);
		$star_selector = $loop_course_container." .tutor-course-ratings .tutor-ratings-stars span";
        $stars_section->addStyleControls(
        	array(
        		array(
					"name" 		=> __('Star Color'),
					"selector" 	=> $star_selector,
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Star Size'),
					"selector" 	=> $star_selector,
					"property" 	=> 'font-size',
				)
        	)
		);
		$stars_section = $course_grid->typographySection(__("Average Rating"), $loop_course_container . ' .tutor-ratings-average', $this);
		$stars_section = $course_grid->typographySection(__("Total Ratings"), $loop_course_container . ' .tutor-ratings-count', $this);
		
		$course_grid->typographySection(__("Course Title"), $loop_course_container.' .tutor-course-name a', $this);
		$course_grid->typographySection(__("Meta Icon"), $loop_course_container.' .tutor-meta .tutor-meta-icon', $this);
		$course_grid->typographySection(__("Meta Info"), $loop_course_container.' .tutor-meta .tutor-meta-value', $this);
		$course_grid->typographySection(__("Author Label"), $loop_course_container.' .tutor-meta', $this);
		$course_grid->typographySection(__("Author Value"), $loop_course_container.' .tutor-meta a, '.$loop_course_container.' .tutor-course-lising-category a', $this);
		
		$loop_course_container_footer = $course_grid_selector.' .tutor-card-footer';
		$course_grid->typographySection(__("Course Price"), $loop_course_container_footer.' .list-item-price span', $this);

		$add_to_cart_btn = $course_grid->addControlSection("add_to_cart_button", __("Add to Cart"), "assets/icon.png", $this);
		$add_to_cart_btn_selector1 = $enrollment_box_selector.' .tutor-btn-primary';
        $add_to_cart_btn_selector2 = $enrollment_box_selector.' .tutor-btn-outline-primary';
        $add_to_cart_btn_selector = $add_to_cart_btn_selector1.', '.$add_to_cart_btn_selector2;
        $add_to_cart_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings"),
            $add_to_cart_btn_selector
        );
        $add_to_cart_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" =>__('Hover Background Color'),
                    "selector" => $add_to_cart_btn_selector1.':hover, '.$add_to_cart_btn_selector2.':hover',
                    "property" => 'background-color',
                )
            )
        );
		
		/* grid border and shadows */
		$course_grid->borderSection(__("Border"), $course_grid_selector, $this);
        $course_grid->borderSection(__("Hover Border"), $course_grid_selector.":hover", $this);
		$course_grid->boxShadowSection(__("Box Shadow"), $course_grid_selector, $this);
		$course_grid->boxShadowSection(__("Hover Box Shadow"), $course_grid_selector.":hover", $this);

		/* grid spacing */
		$grid_spacing = $course_grid->addControlSection("grid_spacing", __("Spacing"), "assets/icon.png", $this);
		$grid_spacing->addPreset("padding", "grid_padding", __("Padding"), $course_grid_selector);
		$grid_spacing->addPreset("margin", "grid_margin", __("Margin"), $course_grid_selector);
		
		/* Pagination */
		$pagination_selector = $selector.' .tutor-pagination';
        $pagination = $this->addControlSection("pagination", __("Pagination"), "assets/icon.png", $this);

        $pagination->addStyleControls(
             array(
                array(
                    "selector" => $pagination_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __("Links Text Color"),
                    "selector" => $pagination_selector." a",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Links Background"),
                    "selector" => $pagination_selector." a",
                    "property" => 'background-color',
                ),
                //hover
                array(
                    "name" => __("Hover Text Color"),
                    "selector" => $pagination_selector." a:hover",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Hover Background"),
                    "selector" => $pagination_selector." a:hover",
                    "property" => 'background-color',
                ),
                //Active
                array(
                    "name" => __("Active Text Color"),
                    "selector" => $pagination_selector." span.current",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Active Background"),
                    "selector" => $pagination_selector." span.current",
                    "property" => 'background-color',
                ),
            )
		);
		//border and box shadow
		$pagination->borderSection(__("Border"), $pagination_selector, $this);
        $pagination->borderSection(__("Hover Border"), $pagination_selector, $this);
        $pagination->boxShadowSection(__("Box Shadow"), $pagination_selector, $this);
		$pagination->boxShadowSection(__("Hover Box Shadow"), $pagination_selector, $this);
		
		//pagination spacing
		$pagination_items_selector = $pagination_selector.' a, '.$pagination_selector.' span';
		$pagination_spacing = $pagination->addControlSection("spacing", __("Spacing"), "assets/icon.png", $this);
        $pagination_spacing->addPreset("padding", "pagination_item_padding", __("Padding"), $pagination_items_selector);
		$pagination_spacing->addPreset("margin", "pagination_item_margin", __("Margin"), $pagination_items_selector);
	}
}


new ArchiveCourse();