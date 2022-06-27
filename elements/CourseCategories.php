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
        ?>
        <div class="tutor-meta tutor-course-details-info"> 
        <?php
        $course_categories  = get_tutor_course_categories();
         if( !empty( $course_categories ) && is_array( $course_categories ) && count( $course_categories ) ) : ?>
            <?php esc_html_e('Categories:', 'tutor'); ?>
            <?php
                $category_links = array();
                foreach ( $course_categories as $course_category ) :
                    $category_name = $course_category->name;
                    $category_link = get_term_link($course_category->term_id);
                    $category_links[] = wp_sprintf( '<a href="%1$s">%2$s</a>', esc_url( $category_link ), esc_html( $category_name ) );
                endforeach;
                echo implode(', ', $category_links);
            ?>
        <?php else : ?>
            <?php _e('Uncategorized', 'tutor'); ?>
        <?php endif; ?>
        </div>
    <?php   
    }

    function controls() {
        $typography_selector = ".tutor-course-details-info";
        $this->typographySection(__('Label Typography'), $typography_selector);
        $this->typographySection(__('Category Typography'), $typography_selector.' a');
    }

}

new CourseCategories();