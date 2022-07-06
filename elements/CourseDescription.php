<?php
namespace Oxygen\TutorElements;

class CourseDescription extends \OxygenTutorElements {

	function name() {
		return 'Course Content';
	}

	function tutor_button_place() {
		return "single_course";
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		include_once otlms_get_template('course/content');
	}

	function class_names() {
		return array('tutor-course-description', 'oxy-tutor-element');
	}

	function controls() {

		$selector = '.tutor-course-details-page';

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
		
	}

}

new CourseDescription();