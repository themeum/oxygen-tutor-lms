<?php
namespace Oxygen\TutorElements;

class CourseReviews extends \OxygenTutorElements {

	function name() {
        return 'Reviews';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/review');
    }

    function controls() {
        $review_selector = ".tutor-course-reviews";
        $this->typographySection(__("Review Title"), '.tutor-course-reviews h3', $this);

        /* Review average section */
        $review_avg_section_selector = $review_selector." .tutor-review-summary";
        $review_avg_section = $this->addControlSection("rating_avg", __("Review Avg","oxygen-tutor-lms"), "assets/icon.png", $this);
        $review_avg_section->typographySection(__("Rating Number"), $review_avg_section_selector.' .tutor-review-summary-average-rating', $this);
        $review_avg_stars = $review_avg_section->addControlSection("review_avg_stars", __("Rating Stars"), "assets/icon.png", $this);
        $review_avg_stars_selector = $review_avg_section_selector." .tutor-ratings-stars span";
        $review_avg_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $review_avg_stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size','oxygen-tutor-lms'),
                    "selector" => $review_avg_stars_selector,
                    "property" => 'font-size',
                )
            )
        );
        $review_avg_section->typographySection(__("Total Count","oxygen-tutor-lms"), $review_avg_section_selector.' div.tutor-color-secondary', $this);

        $review_avg_section_count_meter = $review_avg_section_selector.' .tutor-review-summary-ratings';
        $review_avg_right_bar_selector = $review_avg_section_count_meter.' .tutor-col';
        $review_avg_right_bar_main_selector = $review_avg_right_bar_selector.' .tutor-progress-bar.tutor-ratings-progress-bar';
        $review_avg_right_bar_fill_selector = $review_avg_right_bar_main_selector.' .tutor-progress-value';
        $review_avg_right_bar = $review_avg_section->addControlSection("review_avg_right_bar_main", __("Right Rating Bar"), "assets/icon.png", $this);
        $review_avg_right_bar->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $review_avg_right_bar_main_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Fill Color','oxygen-tutor-lms'),
                    "selector" => $review_avg_right_bar_fill_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Height','oxygen-tutor-lms'),
                    "selector" => $review_avg_right_bar_main_selector.', '.$review_avg_right_bar_fill_selector,
                    "property" => 'height',
                )
            )
        );
        $review_avg_right_bar->addPreset(
            "padding",
            "review_avg_right_bar_main_padding",
            __("Padding","oxygen-tutor-lms"),
            $review_avg_right_bar_main_selector
        );
        $review_avg_right_bar->addPreset(
            "margin",
            "review_avg_right_bar_main_margin",
            __("Margin","oxygen-tutor-lms"),
            $review_avg_right_bar_main_selector
        );
        
        $review_avg_right_stars_selector = $review_avg_section_count_meter.' .tutor-ratings-stars span';
        $review_avg_right_stars = $review_avg_section->addControlSection("review_avg_right_stars", __("Right Rating Stars","oxygen-tutor-lms"), "assets/icon.png", $this);
        $review_avg_right_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $review_avg_right_stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size','oxygen-tutor-lms'),
                    "selector" => $review_avg_right_stars_selector,
                    "property" => 'font-size',
                )
            )
        );

        $review_avg_section->typographySection(__("Right Rating Text","oxygen-tutor-lms"), $review_avg_section_count_meter.' .tutor-ratings-average', $this);

        /* Review list section */
        $review_list_section_selector = $review_selector." .tutor-card-list-item";
        $review_list_section = $this->addControlSection("rating_list", __("Review list","oxygen-tutor-lms"), "assets/icon.png", $this);
        $reviewer_image_selector = $review_list_section_selector." .tutor-avatar";
        $reviewer_image = $review_list_section->addControlSection("image", __("Image","oxygen-tutor-lms"), "assets/icon.png", $this);
		$reviewer_image->addStyleControls(
			array(
				array(
                	"name" => __('Height','oxygen-tutor-lms'),
                	"selector" => $reviewer_image_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width','oxygen-tutor-lms'),
                	"selector" => $reviewer_image_selector,
					"property" => 'width',
				),
				array(
                	"name" => __('Font Size','oxygen-tutor-lms'),
                	"selector" => $reviewer_image_selector,
					"property" => 'font-size',
				),
				array(
                	"name" => __('Line Height','oxygen-tutor-lms'),
                	"selector" => $reviewer_image_selector,
					"property" => 'line-height',
				)
			)
        );
        $review_list_section->typographySection(__("Name","oxygen-tutor-lms"), $review_list_section_selector.' .tutor-reviewer-name, .tutor-reviewer-name a', $this);
        $review_list_section->typographySection(__("Time","oxygen-tutor-lms"), $review_list_section_selector.' .tutor-reviewed-on', $this);

        $reviewer_stars = $review_list_section->addControlSection("reviewer_stars", __("Stars","oxygen-tutor-lms"), "assets/icon.png", $this);
        $reviewer_stars_selector = $review_list_section_selector." .tutor-ratings-stars span";
        $reviewer_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $reviewer_stars_selector.' i',
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size','oxygen-tutor-lms'),
                    "selector" => $reviewer_stars_selector,
                    "property" => 'font-size',
                )
            )
        );
        $review_list_section->typographySection(__("Content","oxygen-tutor-lms"), $review_list_section_selector.' .tutor-review-comment', $this);
    }

}

new CourseReviews();