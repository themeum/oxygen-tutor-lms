<?php
namespace Oxygen\TutorElements;

class ArchiveCourseCategories extends \OxygenTutorElements {

	function name() {
		return 'Archive Categories';
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

	public function tutor_button_place() {
		return "archive";
	}

	function controls() {
		$selector = '.tutor-courses-wrap';
		/* Layout */
		$layout_section = $this->addControlSection("layout", __("Layout"), "assets/icon.png", $this);
		$layout_section->addPreset("padding", "container_padding", __("Container Padding"), $selector);
		$layout_section->addPreset("margin", "container_margin", __("Container Margin"), $selector);

		/* Filter section */
		$filter_selector = $selector.' .tutor-course-filter-wrap';
		$this->typographySection(__("Results Count"), $filter_selector.' .tutor-course-archive-results-wrap', $this);

		$sorting_select = $this->addControlSection("sorting_select", __("Sorting Select"), "assets/icon.png", $this);
        $sorting_select_selector = $filter_selector.' .tutor-course-archive-filters-wrap .tutor-course-filter-form select';
        $sorting_select->addPreset( "padding", "sorting_select_padding", __("Select Padding"), $sorting_select_selector);
        $sorting_select->typographySection(__("Typography"), $sorting_select_selector, $this);
        $sorting_select->borderSection(__("Border"), $sorting_select_selector, $this);
        $sorting_select->borderSection(__("Focus Border"), $sorting_select_selector.":focus", $this);
        $sorting_select->boxShadowSection(__("Box Shadow"), $sorting_select_selector, $this);
        $sorting_select->boxShadowSection(__("Focus Box Shadow"), $sorting_select_selector.":focus", $this);

		$filter_section_spacing = $this->addControlSection("filter_spacing", __("Filter Spacing"), "assets/icon.png", $this);
		$filter_section_spacing->addPreset("padding", "filter_padding", __("Padding"), $filter_selector);
		$filter_section_spacing->addPreset("margin", "filter_margin", __("Margin"), $filter_selector);

		/* Course grid */
		$course_grid = $this->addControlSection("course_grid", __("Course Grid"), "assets/icon.png", $this);
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
		
		/* Pagination */
		$pagination_selector = $selector.' .tutor-pagination-wrap';
        $pagination = $this->addControlSection("pagination", __("Pagination"), "assets/icon.png", $this);
        $pagination_align = $pagination->addControl("buttons-list", "pagination_align", __("Items Align") );
        
		$pagination_align->setValue(array(
			"left"		=> "Left",
			"center" 	=> "Center", 
			"right" 	=> "Right" 
		));
        
		$pagination_align->setValueCSS(array(
            "left" => "$pagination_selector {
                text-align: left;
            }",
            "center" => "$pagination_selector {
                text-align: center;
            }",
            "right" => "$pagination_selector {
                text-align: right;
            }"
        ));

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
                //current
                array(
                    "name" => __("Current Text Color"),
                    "selector" => $pagination_selector." span.current",
                    "property" => 'color',
                ),
                array(
                    "name" => __("Current Background"),
                    "selector" => $pagination_selector." span.current",
                    "property" => 'background-color',
                ),
            )
		);
		//border and box shadow
		$pagination->borderSection(__("Border"), $pagination_selector.' a', $this);
        $pagination->borderSection(__("Hover Border"), $pagination_selector." a:hover", $this);
        $pagination->boxShadowSection(__("Box Shadow"), $pagination_selector.' a', $this);
		$pagination->boxShadowSection(__("Hover Box Shadow"), $pagination_selector." a:hover", $this);

		$pagination->borderSection(__("Current Border"), $pagination_selector.' span', $this);
		$pagination->boxShadowSection(__("Current Box Shadow"), $pagination_selector." span", $this);
		
		//spacing
		$pagination_items_selector = $pagination_selector.' a, '.$pagination_selector.' span';
		$pagination_spacing = $pagination->addControlSection("spacing", __("Spacing"), "assets/icon.png", $this);
        $pagination_spacing->addPreset("padding", "pagination_item_padding", __("Padding"), $pagination_items_selector);
        $pagination_spacing->addPreset("margin", "pagination_item_margin", __("Margin"), $pagination_items_selector);
	}
}


new ArchiveCourseCategories();