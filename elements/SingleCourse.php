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
		$this->typographySection('Title', $selector.' .tutor-course-header-h1', $this);
		
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
        $course_author->typographySection('Label', $author_selector.' .tutor-single-course-author-name span', $this);
		$course_author->typographySection('Name', $author_selector.' .tutor-single-course-author-name a', $this);
		
		/* Course Levels */
		$course_level = $this->addControlSection("level", __("Level"), "assets/icon.png", $this);
		$level_selector =  $selector." .tutor-single-course-meta ul li.tutor-course-level";
        $course_level->typographySection('Label', $level_selector.' strong', $this);
		$course_level->typographySection('Value', $level_selector, $this);
		
		/* Course Share */
		$course_share = $this->addControlSection("share", __("Share"), "assets/icon.png", $this);
		$share_selector = $selector." .tutor-single-course-meta .tutor-social-share";
        $share_layout = $course_share->addControlSection("layout", __("Layout"), "assets/icon.png", $this);
        $share_items_align = $share_layout->addControl("buttons-list", "items_align", __("Items Align") );
        $share_items_align->setValue(array(
            "left"		=> "Left",
            "right"    => "Right" 
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
        $course_lead_meta->typographySection('Label', $lead_meta_selector.' span', $this);
		$course_lead_meta->typographySection('Value', $lead_meta_selector.', '.$lead_meta_selector.' a', $this);

		/* Course about */
		$course_about = $this->addControlSection("about", __("About"), "assets/icon.png", $this);
		$about_selector =  $selector." .tutor-course-summery";
        $course_about->typographySection('Heading', $about_selector.' .tutor-segment-title', $this);
		$course_about->typographySection('Paragraph', $about_selector, $this);

		/* Course description */
		$course_description = $this->addControlSection("description", __("Description"), "assets/icon.png", $this);
		$description_selector =  $selector." .tutor-course-content-wrap";
        $course_description->typographySection('Heading', $description_selector.' .course-content-title h4', $this);
		$course_description->typographySection('Paragraph', $description_selector.' .tutor-course-content-content', $this);
		
		/* Course benefits */
		$course_benefits = $this->addControlSection("benefits", __("Benefits"), "assets/icon.png", $this);
		$benefits_selector = $selector." .tutor-course-benefits-wrap";
		$benefits_item_selector = $benefits_selector." .tutor-course-benefits-items";
        $course_benefits->typographySection('Title', $benefits_selector.' .course-benefits-title h4', $this);
        $benefits_content_icon = $course_benefits->addControlSection("benefits_content_icon", __("Content Icon"), "assets/icon.png", $this);
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
		$course_benefits->typographySection(__('Content Typography'), $benefits_item_selector, $this);
		$benefits_content_spacing = $course_benefits->addControlSection("benefits_content_spacing", __("Spacing"), "assets/icon.png", $this);
        $benefits_content_spacing->addPreset(
            "padding",
            "benefits_content_item_padding",
            __("Items Paddings"),
            $benefits_item_selector.' li'
		);
		
		/* Course Curriculum */
		$course_curriculum = $this->addControlSection("curriculum", __("Curriculum"), "assets/icon.png", $this);
		$curriculum_selector = $selector." .tutor-course-topics-wrap";
		$curriculum_topic_header = $curriculum_selector." .tutor-course-topics-header";
        $course_curriculum->typographySection('Header Title', $curriculum_topic_header.' .tutor-segment-title', $this);
        $course_curriculum->typographySection('Header Info', $curriculum_topic_header. ' .tutor-course-topics-header-right', $this);

        $course_topic = $curriculum_selector." .tutor-course-topic";
        $course_curriculum->typographySection('Topic Title', $course_topic.' .tutor-course-title h4', $this);
        $icon_selector = $course_topic. ' .tutor-course-lesson h5 i';
        $icon_section = $course_curriculum->addControlSection("lesson-icon", __("Lesson Icon"), "assets/icon.png", $this);
		$icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Font Size'),
                	"selector" => $icon_selector,
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Font Color'),
                	"selector" => $icon_selector,
					"property" => 'color',
				)
			)
        );
        $course_curriculum->typographySection('Lesson Title', $course_topic. ' .tutor-course-lesson h5, .tutor-course-lesson h5 a', $this);
        $curriculum_space_section = $course_curriculum->addControlSection("topic-spacing", __("Spacing"), "assets/icon.png", $this);
        $curriculum_space_section->addPreset(
            "padding",
            "topic_title_padding",
            __("Topic Title Paddings"),
            '.tutor-course-title'
        );
        $curriculum_space_section->addPreset(
            "padding",
            "lesson_title_padding",
            __("Lesson Title Paddings"),
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
        $rating_section = $course_instructors->addControlSection("rating", __("Rating"), "assets/icon.png", $this);
        $star_selector = $info_selector." .tutor-star-rating-group";
        $rating_section->addStyleControl(
			array(
                "name" => __('Stars Size'),
                "selector" => $star_selector,
                "property" => 'font-size',
            )
        );
        $rating_section->addStyleControl(
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
    }
}


new SingleCourse();