<?php
namespace Oxygen\TutorElements;

class SingleCourse extends \OxygenTutorElements {

	function name() {
		return 'Single Course';
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
		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === $course_post_type){
			$student_must_login_to_view_course = tutor_utils()->get_option('student_must_login_to_view_course');
			if ($student_must_login_to_view_course){
				if ( ! is_user_logged_in() ) {
					$template = otlms_get_template( 'login' );
					include_once $template;
					return;
				}
			}

			wp_reset_query();
            
			if (empty( $wp_query->query_vars['course_subpage'])) {
				$template = otlms_get_template( 'single-course' );
				if ( is_user_logged_in() ) {
					if ( tutor_utils()->is_enrolled() ) {
						$template = otlms_get_template( 'single-course-enrolled' );
					}
				}
			}else{
				//If Course Subpage Exists
				if ( is_user_logged_in() ) {
					$course_subpage = $wp_query->query_vars['course_subpage'];
					$template = otlms_get_template( 'single-course-enrolled-' . $course_subpage );
					if ( ! file_exists( $template ) ) {
						$template = otlms_get_template( 'single-course-enrolled-subpage' );
					}
				}else{
					$template = otlms_get_template('login');
				}
			}
			include_once $template;
		}
		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "single_template";
	}

	function controls() {
		$selector = '.tutor-wrap.type-courses';
		/* Course Rating */
		$course_rating = $this->addControlSection("rating", __("Rating"), "assets/icon.png", $this);
		$star_selector = $selector." .tutor-course-details-ratings .tutor-ratings .tutor-ratings-stars";
		$course_rating->addStyleControls(
            array(
                array(
                    "name" => __('Stars Size'),
                    "selector" => $star_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __('Stars Color'),
                    "selector" => $star_selector,
                    "property" => 'color',
                )
            )
        );
		
		/* Course Title */
		$this->typographySection(__('Title'), $selector.' .tutor-course-details-title', $this);
		
		/* Course Author */
		$course_author = $this->addControlSection("author", __("Author"), "assets/icon.png", $this);
		$author_selector = $selector." .tutor-meta";
		$author_image = $course_author->addControlSection("image", __("Image"), "assets/icon.png", $this);
		$img_selector = $author_selector." .tutor-avatar";
		$author_image->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => $img_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width'),
                	"selector" => $img_selector,
					"property" => 'width',
				),
				array(
                	"name" => __('Font Size'),
                	"selector" => $img_selector,
					"property" => 'font-size',
				),
				array(
                	"name" => __('Line Height'),
                	"selector" => $img_selector,
					"property" => 'line-height',
				)
			)
		);
        $course_author->typographySection(__('Label'), $author_selector.' span.tutor-mr-16', $this);
		$course_author->typographySection(__('Name'), $author_selector.' span.tutor-mr-16 a', $this);
        
		/* Course lead meta */
		$course_lead_meta = $this->addControlSection("lead_meta", __("Course Meta"), "assets/icon.png", $this);
		$lead_meta_selector =  $selector." .tutor-meta";
        $course_lead_meta->typographySection(__('Label'), $lead_meta_selector.' div', $this);
		$course_lead_meta->typographySection(__('Value'), $lead_meta_selector.' div a', $this);
		
		/* Course Levels */
		$course_level = $this->addControlSection("level", __("Level"), "assets/icon.png", $this);
		$level_selector =  $selector." .tutor-single-course-meta ul li.tutor-course-level";
        $course_level->typographySection(__('Label'), $level_selector.' strong', $this);
		$course_level->typographySection(__('Value'), $level_selector, $this);
		
		/* Course Share */
		$course_share = $this->addControlSection("share", __("Share & Wishlist"), "assets/icon.png", $this);
		$share_selector = $selector." .tutor-course-details-actions";
        /*$share_layout = $course_share->addControlSection("layout", __("Layout"), "assets/icon.png", $this);
        $share_items_align = $share_layout->addControl("buttons-list", "items_align", __("Items Align") );
        $share_items_align->setValue(array(
            "left"		=> __("Left"),
            "right"    => __("Right") 
        ));
        $share_items_align->setValueCSS( array(
            "left" => "$share_selector {
                float: left;
            }",
            "right" => "$share_selector {
                float: right;
            }"
        ));*/
        $course_share->typographySection('Label', $share_selector.' .tutor-btn-ghost', $this);
        $course_share->typographySection('Original Icons', $share_selector.' .tutor-btn-ghost i, .tutor-btn-ghost span', $this);
		$course_share->typographySection('Hovered Icons', $share_selector.' .tutor-btn-ghost i:hover, .tutor-btn-ghost span:hover', $this);

		/* Course about */
		$course_about = $this->addControlSection("about", __("About Course"), "assets/icon.png", $this);
		$about_selector =  $selector." .tutor-course-details-content";
        $course_about->typographySection(__('Heading'), $about_selector.' h2 ', $this);
		$course_about->typographySection(__('Paragraph'), $about_selector.' div ', $this);
		
		/* Course benefits */
		$course_benefits = $this->addControlSection("benefits", __("What Will You Learn?"), "assets/icon.png", $this);
		$benefits_selector = $selector." #tutor-course-details-tab-info .tutor-course-details-widget";
		$benefits_item_selector = $benefits_selector." .tutor-course-details-widget-list";
        $course_benefits->typographySection(__('Title'), $benefits_selector.' .tutor-course-details-widget-title', $this);
        $benefits_content_icon = $course_benefits->addControlSection("benefits_content_icon", __("Icon"), "assets/icon.png", $this);
		$benefits_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $benefits_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $benefits_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$course_benefits->typographySection(__('Items Typography'), $benefits_item_selector.' li span', $this);
		$benefits_content_spacing = $course_benefits->addControlSection("benefits_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $benefits_content_spacing->addPreset(
            "padding",
            "benefits_content_item_padding",
            __("Items Padding"),
            $benefits_item_selector.' li'
		);
		$benefits_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $benefits_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
		
		/* Course Curriculum */
		$course_curriculum = $this->addControlSection("curriculum", __("Curriculum"), "assets/icon.png", $this);
		$curriculum_selector = $selector." #tutor-course-details-tab-info .tutor-mt-40";
        $course_curriculum->typographySection(__('Header Title'), $curriculum_selector.' h3', $this);

        $course_topic = $curriculum_selector." .tutor-accordion .tutor-accordion-item";
        $course_curriculum->typographySection(__('Topic Title'), $course_topic.' .tutor-accordion-item-header, .tutor-accordion-item-header::after', $this);
        $course_curriculum->typographySection(__('Active Topic Title'), $course_topic.' .tutor-accordion-item-header.is-active, .tutor-accordion-item-header.is-active::after', $this);

        $course_curriculum->typographySection(__('Lesson, Quiz & Assignment Title'), $course_topic. ' .tutor-course-content-list-item-title, .tutor-course-content-list-item-title a', $this);
        $icon_selector = $course_topic. ' .tutor-course-content-list-item .tutor-course-content-list-item-icon, .tutor-course-content-list-item .tutor-course-content-list-item-status';
        $icon_section = $course_curriculum->addControlSection("lesson-icon", __("Lesson, Quiz & Assignment Icon"), "assets/icon.png", $this);
		$icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $icon_selector,
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $icon_selector,
					"property" => 'color',
				)
			)
        );

		/* Course Reviews */
		$review_selector = $selector." #tutor-course-details-tab-reviews";
        $this->typographySection(__("Review Title"), '#tutor-course-details-tab-reviews h3', $this);

        /* Review average section */
        $review_avg_section_selector = $review_selector." .tutor-review-summary";
        $review_avg_section = $this->addControlSection("rating_avg", __("Review Avg"), "assets/icon.png", $this);
        $review_avg_section->typographySection(__("Rating Number"), $review_avg_section_selector.' .tutor-review-summary-average-rating', $this);
        $review_avg_stars = $review_avg_section->addControlSection("review_avg_stars", __("Rating Stars"), "assets/icon.png", $this);
        $review_avg_stars_selector = $review_avg_section_selector." .tutor-ratings-stars span";
        $review_avg_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $review_avg_stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size'),
                    "selector" => $review_avg_stars_selector,
                    "property" => 'font-size',
                )
            )
        );
        $review_avg_section->typographySection(__("Total Count"), $review_avg_section_selector.' div.tutor-color-secondary', $this);

        $review_avg_section_count_meter = $review_avg_section_selector.' .tutor-review-summary-ratings';
        $review_avg_right_bar_selector = $review_avg_section_count_meter.' .tutor-col';
        $review_avg_right_bar_main_selector = $review_avg_right_bar_selector.' .tutor-progress-bar.tutor-ratings-progress-bar';
        $review_avg_right_bar_fill_selector = $review_avg_right_bar_main_selector.' .tutor-progress-value';
        $review_avg_right_bar = $review_avg_section->addControlSection("review_avg_right_bar_main", __("Right Rating Bar"), "assets/icon.png", $this);
        $review_avg_right_bar->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $review_avg_right_bar_main_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Fill Color'),
                    "selector" => $review_avg_right_bar_fill_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Height'),
                    "selector" => $review_avg_right_bar_main_selector.', '.$review_avg_right_bar_fill_selector,
                    "property" => 'height',
                )
            )
        );
        $review_avg_right_bar->addPreset(
            "padding",
            "review_avg_right_bar_main_padding",
            __("Padding"),
            $review_avg_right_bar_main_selector
        );
        $review_avg_right_bar->addPreset(
            "margin",
            "review_avg_right_bar_main_margin",
            __("Margin"),
            $review_avg_right_bar_main_selector
        );
        
        $review_avg_right_stars_selector = $review_avg_section_count_meter.' .tutor-ratings-stars span';
        $review_avg_right_stars = $review_avg_section->addControlSection("review_avg_right_stars", __("Right Rating Stars"), "assets/icon.png", $this);
        $review_avg_right_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $review_avg_right_stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size'),
                    "selector" => $review_avg_right_stars_selector,
                    "property" => 'font-size',
                )
            )
        );

        $review_avg_section->typographySection(__("Right Rating Text"), $review_avg_section_count_meter.' .tutor-ratings-average', $this);

        /* Review list section */
        $review_list_section_selector = $review_selector." .tutor-card-list-item";
        $review_list_section = $this->addControlSection("rating_list", __("Review list"), "assets/icon.png", $this);
        $reviewer_image_selector = $review_list_section_selector." .tutor-avatar";
        $reviewer_image = $review_list_section->addControlSection("image", __("Image"), "assets/icon.png", $this);
		$reviewer_image->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => $reviewer_image_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width'),
                	"selector" => $reviewer_image_selector,
					"property" => 'width',
				),
				array(
                	"name" => __('Font Size'),
                	"selector" => $reviewer_image_selector,
					"property" => 'font-size',
				),
				array(
                	"name" => __('Line Height'),
                	"selector" => $reviewer_image_selector,
					"property" => 'line-height',
				)
			)
        );
        $review_list_section->typographySection(__("Name"), $review_list_section_selector.' .tutor-reviewer-name, .tutor-reviewer-name a', $this);
        $review_list_section->typographySection(__("Time"), $review_list_section_selector.' .tutor-reviewed-on', $this);

        $reviewer_stars = $review_list_section->addControlSection("reviewer_stars", __("Stars"), "assets/icon.png", $this);
        $reviewer_stars_selector = $review_list_section_selector." .tutor-ratings-stars span";
        $reviewer_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $reviewer_stars_selector.' i',
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size'),
                    "selector" => $reviewer_stars_selector,
                    "property" => 'font-size',
                )
            )
        );
        $review_list_section->typographySection(__("Content"), $review_list_section_selector.' .tutor-review-comment', $this);


		/* Course enrollment box */
		$enrollment_box_selector = $selector." .tutor-sidebar-card";
		$course_enrollment_box = $this->addControlSection("enrollment_box", __("Enrollment Box"), "assets/icon.png", $this);
        $course_enrollment_box->typographySection(__('Course Price'), $enrollment_box_selector.' .tutor-course-single-pricing span', $this);
        
        $course_enrollment_box->typographySection(__('Course Progress Title'), $enrollment_box_selector.' .tutor-course-progress-wrapper h3', $this);
        $course_enrollment_box->typographySection(__('Course Progress Text'), $enrollment_box_selector.' .list-item-progress span', $this);
        $course_progress_bar_main_selector = $enrollment_box_selector.' .tutor-progress-bar';
        $course_progress_bar_fill_selector = $course_progress_bar_main_selector.' .tutor-progress-value';
        $course_progress_bar = $course_enrollment_box->addControlSection("course_progress_bar_main", __("Course Progress Bar"), "assets/icon.png", $this);
        $course_progress_bar->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $course_progress_bar_main_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Fill Color'),
                    "selector" => $course_progress_bar_fill_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Height'),
                    "selector" => $course_progress_bar_main_selector.', '.$course_progress_bar_fill_selector,
                    "property" => 'height',
                )
            )
        );
		
		/* Add to Cart & Enroll Button */
        $add_to_cart_btn = $this->addControlSection("add_to_cart_btn", __("Cart & Enroll Button"), "assets/icon.png", $this);
        $add_to_cart_btn_selector1 = $enrollment_box_selector.' .tutor-btn-primary';
        $add_to_cart_btn_selector2 = $enrollment_box_selector.' .tutor-btn-primary';
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
        $add_to_cart_btn->typographySection(__("Typography"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->borderSection(__("Borders"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->borderSection(__("Hover Borders"), $add_to_cart_btn_selector.":hover", $this);
        $add_to_cart_btn->boxShadowSection(__("Shadow"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->boxShadowSection(__("Hover Shadow"), $add_to_cart_btn_selector.":hover", $this);

        /* Certificate & Retake */
        $enroll_btn = $this->addControlSection("enroll_button", __("Certificate & Retake Button"), "assets/icon.png", $this);
        $enroll_btn_selector = $enrollment_box_selector.' .tutor-btn-outline-primary';
        $enroll_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings"),
            $enroll_btn_selector
        );
        $enroll_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $enroll_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color'),
                    "selector" => $enroll_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $enroll_btn_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );
        $enroll_btn->typographySection(__("Typography"), $enroll_btn_selector, $this);
        $enroll_btn->borderSection(__("Borders"), $enroll_btn_selector, $this);
        $enroll_btn->borderSection(__("Hover Borders"), $enroll_btn_selector.":hover", $this);
        $enroll_btn->boxShadowSection(__("Shadow"), $enroll_btn_selector, $this);
        $enroll_btn->boxShadowSection(__("Hover Shadow"), $enroll_btn_selector.":hover", $this);

        /* Course Info */
        $course_info = $this->addControlSection("course_information", __("Course Information"), "assets/icon.png", $this);
        $course_info_selector = $enrollment_box_selector.' .tutor-card-footer';
        $course_info->typographySection(__('Course Information Text'), $course_info_selector.' .tutor-color-secondary', $this);
        $course_info->typographySection(__('Course Information Icon'), $course_info_selector.' .tutor-color-black', $this);

		/* Course instructors */
		$course_instructors = $this->addControlSection("instructors", __("Instructors"), "assets/icon.png", $this);
		$instructors_selector = $selector." .tutor-course-details-instructors";
        $course_instructors->typographySection(__('Title'), $instructors_selector.' h3', $this);
        $instructors_img_selector = $instructors_selector." .tutor-avatar";
        $img_section = $course_instructors->addControlSection("instructors_image", __("Image"), "assets/icon.png", $this);
        $img_section->addStyleControls(
            array(
                array(
                    "name" => __('Height'),
                    "selector" => $instructors_img_selector,
                    "property" => 'height',
                ),
                array(
                    "name" => __('Width'),
                    "selector" => $instructors_img_selector,
                    "property" => 'width',
                ),
                array(
                    "name" => __('Font Size'),
                    "selector" => $instructors_img_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __('Line Height'),
                    "selector" => $instructors_img_selector,
                    "property" => 'line-height',
                )
            )
        );
        $instructors_name_selector = $instructors_selector." a";
        $instructors_designation_selector = $instructors_selector." .tutor-instructor-designation";
        $course_instructors->typographySection(__("Name"), $instructors_name_selector, $this);
        $course_instructors->typographySection(__("Designation"), $instructors_designation_selector, $this);
		
		/* Course materials */
		$course_materials = $this->addControlSection("materials", __("Materials"), "assets/icon.png", $this);
		$materials_selector = $selector." .tutor-single-course-sidebar-more .tutor-course-details-widget";
		$materials_item_selector = $materials_selector." .tutor-course-details-widget-list";
        $course_materials->typographySection(__('Title'), $materials_selector.' .tutor-course-details-widget-title', $this);
		$course_materials->typographySection(__('List Item'), $materials_item_selector, $this);
        $materials_content_icon = $course_materials->addControlSection("materials_content_icon", __("Icon"), "assets/icon.png", $this);
		$materials_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $materials_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $materials_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$materials_content_spacing = $course_materials->addControlSection("materials_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $materials_content_spacing->addPreset(
            "padding",
            "materials_content_item_padding",
            __("Items Padding"),
            $materials_item_selector.' li'
		);
		$materials_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $materials_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
		
		/* Course requirements */
		$course_requirements = $this->addControlSection("requirements", __("Requirements"), "assets/icon.png", $this);
		$requirements_selector = $selector." .tutor-single-course-sidebar-more .tutor-course-details-widget";
		$requirements_item_selector = $requirements_selector." .tutor-course-details-widget-list";
        $course_requirements->typographySection('Title', $requirements_selector.' .tutor-course-details-widget-title', $this);
        $requirements_content_icon = $course_requirements->addControlSection("requirements_content_icon", __("Icon"), "assets/icon.png", $this);
		$requirements_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $requirements_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $requirements_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$course_requirements->typographySection(__('Typography'), $requirements_item_selector, $this);
		$requirements_content_spacing = $course_requirements->addControlSection("requirements_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $requirements_content_spacing->addPreset(
            "padding",
            "requirements_content_item_padding",
            __("Items Padding"),
            $requirements_item_selector.' li'
		);
		$requirements_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $requirements_item_selector.' li',
					"property" => 'line-height',
                )
			)
		);
		
		/* Course target audience */
		$course_target_audience = $this->addControlSection("target_audience", __("Target Audience"), "assets/icon.png", $this);
		$target_audience_selector = $selector." .tutor-single-course-sidebar-more .tutor-course-details-widget";
		$target_audience_item_selector = $target_audience_selector." .tutor-course-details-widget-list";
        $course_target_audience->typographySection('Title', $target_audience_selector.' .tutor-course-details-widget-title', $this);
        $target_audience_content_icon = $course_target_audience->addControlSection("target_audience_content_icon", __("Icon"), "assets/icon.png", $this);
		$target_audience_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $target_audience_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $target_audience_item_selector.' li .tutor-icon-bullet-point',
					"property" => 'color',
				)
			)
        );
		$course_target_audience->typographySection(__('Typography'), $target_audience_item_selector, $this);
		$target_audience_content_spacing = $course_target_audience->addControlSection("target_audience_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $target_audience_content_spacing->addPreset(
            "padding",
            "target_audience_content_item_padding",
            __("Items Padding"),
            $target_audience_item_selector.' li'
		);
		$target_audience_content_spacing->addStyleControls(
			array(
				array(
                	"name" => __('Line Height'),
                	"selector" => $target_audience_item_selector.' li',
					"property" => 'line-height',
                )
			)
        );
    }
}


new SingleCourse();