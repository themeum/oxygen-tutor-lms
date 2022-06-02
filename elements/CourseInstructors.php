<?php
namespace Oxygen\TutorElements;

class CourseInstructors extends \OxygenTutorElements {

	function name() {
        return 'Instructors';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        echo "<div class='tutor-course-instructors'>";
            tutor_course_instructors_html();
        echo "</div>";
    }

    function controls() {
        $selector = ".tutor-course-instructors";
        /* Title */
        $this->typographySection(__("Title"), $selector.' .tutor-segment-title', $this);

        /* Author */
        $author_section = $this->addControlSection("author", __("Author"), "assets/icon.png", $this);
        $img_selector = $selector." .instructor-avatar span";
        $img_section = $author_section->addControlSection("author_image", __("Image"), "assets/icon.png", $this);
        $img_section->addStyleControls(
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
        $name_selector = $selector." .instructor-name a";
        $author_section->typographySection(__("Name"), $name_selector, $this);

        /* Section info */
        $info_selector = $selector." .single-instructor-bottom";
        $info_section = $this->addControlSection("bottom_info", __("Bottom Info"), "assets/icon.png", $this);

        $rating_section = $info_section->addControlSection("rating", __("Rating"), "assets/icon.png", $this);
        $star_selector = $info_selector." .tutor-star-rating-group";
        $rating_section->addStyleControls(
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
        $info_section->typographySection(
            __("Label"), 
            $info_selector.' .rating-digits,'.
            $info_selector.' .courses,'.
            $info_selector.' .students', 
            $this
        );
        $info_section->typographySection(
            __("Value"), 
            $info_selector.' .rating-total-meta,'.
            $info_selector.' .tutor-text-mute', 
            $this
        );
    }
}

new CourseInstructors();