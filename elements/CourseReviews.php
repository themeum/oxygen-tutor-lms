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
        echo "<div class='tutor-course-reviews'>";
        tutor_course_target_reviews_html();
        if (is_user_logged_in() && tutils()->is_enrolled()) {
            tutor_course_target_review_form_html();
        }
        echo "</div>";
    }

    function controls() {
        $selector = ".tutor-course-reviews";
        /* Title */
        $this->typographySection(__("Title"), $selector.' .tutor-segment-title', $this);

        /* Review average section */
        $review_avg_section_selector = $selector." .course-avg-rating-wrap";
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
        $review_list_section_selector = $selector." .tutor-course-reviews-list";
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
    }

}

new CourseReviews();