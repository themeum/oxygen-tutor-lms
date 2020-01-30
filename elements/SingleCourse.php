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
		$star_selector = $selector." .tutor-single-course-rating .tutor-star-rating-group";
		$course_rating->addStyleControl(
			array(
                "name" => __('Stars Size'),
                "selector" => $star_selector,
                "property" => 'font-size',
            )
        );
        $course_rating->addStyleControl(
			array(
                "name" => __('Stars Color'),
                "selector" => $star_selector,
                "property" => 'color',
            )
		);
		
		/* Course Title */
		$this->typographySection(__('Title'), $selector.' .tutor-course-header-h1', $this);
		
		/* Course Author */
		$course_author = $this->addControlSection("author", __("Author"), "assets/icon.png", $this);
		$author_selector = $selector." .tutor-single-course-meta .tutor-single-course-author-meta";
		$author_image = $course_author->addControlSection("image", __("Image"), "assets/icon.png", $this);
		$img_selector = $author_selector." a span";
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
        $course_author->typographySection(__('Label'), $author_selector.' .tutor-single-course-author-name span', $this);
		$course_author->typographySection(__('Name'), $author_selector.' .tutor-single-course-author-name a', $this);
		
		/* Course Levels */
		$course_level = $this->addControlSection("level", __("Level"), "assets/icon.png", $this);
		$level_selector =  $selector." .tutor-single-course-meta ul li.tutor-course-level";
        $course_level->typographySection(__('Label'), $level_selector.' strong', $this);
		$course_level->typographySection(__('Value'), $level_selector, $this);
		
		/* Course Share */
		$course_share = $this->addControlSection("share", __("Share"), "assets/icon.png", $this);
		$share_selector = $selector." .tutor-single-course-meta .tutor-social-share";
        $share_layout = $course_share->addControlSection("layout", __("Layout"), "assets/icon.png", $this);
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
        ));
        $course_share->typographySection('Label', $share_selector.' span', $this);
        $course_share->typographySection('Original Icons', $share_selector.' .tutor-social-share-wrap button', $this);
		$course_share->typographySection('Hovered Icons', $share_selector.' .tutor-social-share-wrap button:hover', $this);
		
		/* Course lead meta */
		$course_lead_meta = $this->addControlSection("lead_meta", __("Lead Meta"), "assets/icon.png", $this);
		$lead_meta_selector =  $selector." .tutor-single-course-meta ul li";
        $course_lead_meta->typographySection(__('Label'), $lead_meta_selector.' span', $this);
		$course_lead_meta->typographySection(__('Value'), $lead_meta_selector.', '.$lead_meta_selector.' a', $this);

		/* Course about */
		$course_about = $this->addControlSection("about", __("About"), "assets/icon.png", $this);
		$about_selector =  $selector." .tutor-course-summery";
        $course_about->typographySection(__('Heading'), $about_selector.' .tutor-segment-title', $this);
		$course_about->typographySection(__('Paragraph'), $about_selector, $this);

		/* Course description */
		$course_description = $this->addControlSection("description", __("Description"), "assets/icon.png", $this);
		$description_selector =  $selector." .tutor-course-content-wrap";
        $course_description->typographySection(__('Heading'), $description_selector.' .course-content-title h4', $this);
		$course_description->typographySection(__('Paragraph'), $description_selector.' .tutor-course-content-content', $this);
		
		/* Course benefits */
		$course_benefits = $this->addControlSection("benefits", __("Benefits"), "assets/icon.png", $this);
		$benefits_selector = $selector." .tutor-course-benefits-wrap";
		$benefits_item_selector = $benefits_selector." .tutor-course-benefits-items";
        $course_benefits->typographySection(__('Title'), $benefits_selector.' .course-benefits-title h4', $this);
        $benefits_content_icon = $course_benefits->addControlSection("benefits_content_icon", __("Icon"), "assets/icon.png", $this);
		$benefits_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $benefits_item_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $benefits_item_selector.' li:before',
					"property" => 'color',
				)
			)
        );
		$course_benefits->typographySection(__('Typography'), $benefits_item_selector, $this);
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
		$curriculum_selector = $selector." .tutor-course-topics-wrap";
		$curriculum_topic_header = $curriculum_selector." .tutor-course-topics-header";
        $course_curriculum->typographySection(__('Header Title'), $curriculum_topic_header.' .tutor-segment-title', $this);
        $course_curriculum->typographySection(__('Header Info'), $curriculum_topic_header. ' .tutor-course-topics-header-right', $this);

        $course_topic = $curriculum_selector." .tutor-course-topic";
        $course_curriculum->typographySection(__('Topic Title'), $course_topic.' .tutor-course-title h4', $this);
        $icon_selector = $course_topic. ' .tutor-course-lesson h5 i';
        $icon_section = $course_curriculum->addControlSection("lesson-icon", __("Lesson Icon"), "assets/icon.png", $this);
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
        $course_curriculum->typographySection(__('Lesson Title'), $course_topic. ' .tutor-course-lesson h5, .tutor-course-lesson h5 a', $this);
        $curriculum_space_section = $course_curriculum->addControlSection("topic-spacing", __("Spacing"), "assets/icon.png", $this);
        $curriculum_space_section->addPreset(
            "padding",
            "topic_title_padding",
            __("Topic Title Padding"),
            '.tutor-course-title'
        );
        $curriculum_space_section->addPreset(
            "padding",
            "lesson_title_padding",
            __("Lesson Title Padding"),
            '.tutor-course-lesson'
		);

		/* Course instructors */
		$course_instructors = $this->addControlSection("instructors", __("Instructors"), "assets/icon.png", $this);
		$instructors_selector = $selector." .tutor-course-instructors-wrap";
        $instructors_img_selector = $instructors_selector." .instructor-avatar span";
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
        $instructors_name_selector = $instructors_selector." .instructor-name a";
        $course_instructors->typographySection(__("Name"), $instructors_name_selector, $this);
        $info_selector = $instructors_selector." .single-instructor-bottom";
        $instructors_rating_section = $course_instructors->addControlSection("instructors_rating", __("Rating"), "assets/icon.png", $this);
        $star_selector = $info_selector." .tutor-star-rating-group";
        $instructors_rating_section->addStyleControl(
			array(
                "name" => __('Stars Size'),
                "selector" => $star_selector,
                "property" => 'font-size',
            )
        );
        $instructors_rating_section->addStyleControl(
			array(
                "name" => __('Stars Color'),
                "selector" => $star_selector,
                "property" => 'color',
            )
        );
        $course_instructors->typographySection(
            __("Label"),
            $info_selector.' .rating-digits,'.
            $info_selector.' .courses,'.
            $info_selector.' .students',
            $this
        );
        $course_instructors->typographySection(
            __("Value"), 
            $info_selector.' .rating-total-meta,'.
            $info_selector.' .tutor-text-mute', 
            $this
		);

		/* Course Reviews */
		$review_selector = $selector." .tutor-course-reviews-wrap";
        $this->typographySection(__("Review Title"), '.course-student-rating-title .tutor-segment-title', $this);

        /* Review average section */
        $review_avg_section_selector = $review_selector." .course-avg-rating-wrap";
        $review_avg_section = $this->addControlSection("rating_avg", __("Review Avg"), "assets/icon.png", $this);
        $review_avg_section->typographySection(__("Rating Text"), $review_avg_section_selector.' .course-avg-rating', $this);
        $review_avg_stars = $review_avg_section->addControlSection("review_avg_stars", __("Rating Stars"), "assets/icon.png", $this);
        $review_avg_stars_selector = $review_avg_section_selector." .tutor-star-rating-group";
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
        $review_avg_section->typographySection(__("Total Count"), $review_avg_section_selector.' .tutor-course-avg-rating-total', $this);
        $review_avg_section_count_meter = $review_avg_section_selector.' .course-ratings-count-meter-wrap';
    
        $review_avg_right_bar_selector = $review_avg_section_count_meter.' .rating-meter-bar-wrap';
        $review_avg_right_bar_main_selector = $review_avg_right_bar_selector.' .rating-meter-bar';
        $review_avg_right_bar_fill_selector = $review_avg_right_bar_main_selector.' .rating-meter-fill-bar';
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
        
        $review_avg_right_stars_selector = $review_avg_section_count_meter.' .rating-meter-col i';
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

        $review_avg_section->typographySection(__("Right Rating Text"), $review_avg_section_count_meter.' .rating-meter-col', $this);

        /* Review list section */
        $review_list_section_selector = $review_selector." .tutor-course-reviews-list";
        $review_list_section = $this->addControlSection("rating_list", __("Review list"), "assets/icon.png", $this);
        $reviewer_image_selector = $review_list_section_selector." .review-avatar span";
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
        $review_list_section->typographySection(__("Name"), $review_list_section_selector.' .review-time-name p:first-child a', $this);
        $review_list_section->typographySection(__("Time"), $review_list_section_selector.' .review-time-name p.review-meta', $this);

        $reviewer_stars = $review_list_section->addControlSection("reviewer_stars", __("Stars"), "assets/icon.png", $this);
        $reviewer_stars_selector = $review_list_section_selector." .tutor-star-rating-group";
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
        $review_list_section->typographySection(__("Content"), $review_list_section_selector.' .review-content p', $this);
        $review_list_spacing = $review_list_section->addControlSection("review_list_spacing", __("Spacing"), "assets/icon.png", $this);
        $review_list_spacing->addPreset(
            "padding",
            "review_list_padding",
            __("Padding"),
            $review_list_section_selector.' .tutor-review-individual-item'
        );


		/* Course enrollment box */
		$enrollment_box_selector = $selector." .tutor-price-preview-box";
		$course_enrollment_box = $this->addControlSection("enrollment_box", __("Enrollment Box"), "assets/icon.png", $this);
		$thumb_selector = $enrollment_box_selector." .tutor-price-box-thumbnail";
		$original_thumb = $course_enrollment_box->addControlSection("tutor_origianl_thumb", __("Original Thumbnails"), "assets/icon.png", $this);
		$original_thumb->addStyleControls(
            array(
                array(
                    "selector" => $thumb_selector." img",
                    "property" => 'opacity',
				),
				array(
                    "selector" => $thumb_selector,
                    "property" => 'background-color',
                ),
            )
        );
		$original_thumb->addStyleControl(
        	array(
				"name" => __("Border Color"),
				"selector" => $thumb_selector,
        		"property" => 'border-color',
        	)
		);
		$original_thumb->addStyleControl(
        	array(
				"name" => __("Border Width"),
				"selector" => $thumb_selector,
        		"property" => 'border-width',
        	)
		);
		$original_thumb->addPreset(
            "margin",
            "tutor_original_thumb_margins",
            __("Margin"),
            $thumb_selector
		);
		$original_thumb->addPreset(
            "box-shadow",
            "tutor_original_thumb_shadow",
            __("Box Shadow"),
            $thumb_selector
		);
		
        /** Hovered Thumbnail */
		$hover_thumb = $course_enrollment_box->addControlSection("tutor_hover_thumb", __("Hovered Thumbnails"), "assets/icon.png", $this);
		$hover_thumb->addStyleControls(
            array(
                array(
                    "selector" => $thumb_selector." img:hover",
                    "property" => 'opacity',
				),
				
				array(
                    "selector" => $thumb_selector.":hover",
                    "property" => 'background-color',
                ),
            )
        );
		$hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Color"),
        		"selector" => $thumb_selector.":hover",
        		"property" => 'border-color',
        	)
		);
		$hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Width"),
        		"selector" => $thumb_selector.":hover",
        		"property" => 'border-width',
        	)
		);
		$hover_thumb->addPreset(
            "box-shadow",
            "tutor_hover_thumb_shadow",
            __("Box Shadow"),
            $thumb_selector.":hover"
		);
		$course_enrollment_box->typographySection(__('Price'), $enrollment_box_selector.' .price, '.$enrollment_box_selector.' .price .woocommerce-Price-amount', $this);
		
		/* Course materials */
		$course_materials = $this->addControlSection("materials", __("Materials"), "assets/icon.png", $this);
		$materials_selector = $selector." .tutor-course-material-includes-wrap";
		$materials_item_selector = $materials_selector." .tutor-course-target-audience-items";
        $course_materials->typographySection(__('Title'), $materials_selector.' > h4.tutor-segment-title', $this);
        $materials_content_icon = $course_materials->addControlSection("materials_content_icon", __("Icon"), "assets/icon.png", $this);
		$materials_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $materials_item_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $materials_item_selector.' li:before',
					"property" => 'color',
				)
			)
        );
		$course_materials->typographySection(__('Typography'), $materials_item_selector, $this);
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
		
		/* Add to Cart Button */
        $add_to_cart_btn = $this->addControlSection("add_to_cart_btn", __("Add to Cart Button"), "assets/icon.png", $this);
        $add_to_cart_btn_selector1 = $enrollment_box_selector.' .tutor-course-purchase-box button';
        $add_to_cart_btn_selector2 = $enrollment_box_selector.' .tutor-course-purchase-box edd-add-to-cart';
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

        /* Enroll Button */
        $enroll_btn = $this->addControlSection("enroll_button", __("Enroll Button"), "assets/icon.png", $this);
        $enroll_btn_selector = $enrollment_box_selector.' .tutor-btn-enroll';
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
		
		/* Course requirements */
		$course_requirements = $this->addControlSection("requirements", __("Requirements"), "assets/icon.png", $this);
		$requirements_selector = $selector." .tutor-course-requirements-wrap";
		$requirements_item_selector = $requirements_selector." .tutor-course-requirements-items";
        $course_requirements->typographySection('Title', $requirements_selector.' .course-requirements-title h4', $this);
        $requirements_content_icon = $course_requirements->addControlSection("requirements_content_icon", __("Icon"), "assets/icon.png", $this);
		$requirements_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $requirements_item_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $requirements_item_selector.' li:before',
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
		$target_audience_selector = $selector." .tutor-course-target-audience-wrap";
		$target_audience_item_selector = $target_audience_selector." .tutor-course-target-audience-items";
        $course_target_audience->typographySection('Title', $target_audience_selector.' > h4.tutor-segment-title', $this);
        $target_audience_content_icon = $course_target_audience->addControlSection("target_audience_content_icon", __("Icon"), "assets/icon.png", $this);
		$target_audience_content_icon->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $target_audience_item_selector.' li:before',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $target_audience_item_selector.' li:before',
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