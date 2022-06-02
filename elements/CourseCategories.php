<?php
namespace Oxygen\TutorElements;

class CourseCategories extends \OxygenTutorElements {

	function name() {
        return 'Categories';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        $course_categories = get_tutor_course_categories();
        if(is_array($course_categories) && count($course_categories)) {
            $markup = '';
            $markup .= "<div class='tutor-single-course-meta-categories'>";
                foreach ($course_categories as $course_category) {
                    $category_name = $course_category->name;
                    $category_link = get_term_link($course_category->term_id);
                    $markup .= " <a href='$category_link'>$category_name</a>";
                }
            $markup .= "</div>";
            echo $markup;
        }
    }

    function controls() {
        $typography_selector = ".tutor-single-course-meta-categories";
        $this->typographySection(__('Typography'), $typography_selector.' a');
    }

}

new CourseCategories();