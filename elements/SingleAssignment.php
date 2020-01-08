<?php
namespace Oxygen\TutorElements;

class SingleAssignment extends \OxygenTutorElements {

	function name() {
		return 'Single Assignments';
	}


	function render($options, $defaults, $content) {
		global $post;

		// add body class
		add_filter('body_class', array($this, "tutor_body_class"));

		if ($content) {

			?>

            <div id="tutor-course-<?php the_ID(); ?>" <?php tutor_container_classes(); ?>>

				<?php do_action('tutor_course/single/before/wrap'); ?>

                <div class='oxy-course-wrapper-inner oxy-inner-content'>
					<?php echo do_shortcode($content); ?>
                </div>

				<?php do_action('tutor_course/single/after/wrap'); ?>

            </div>

			<?php

			// what about handling html structured data, i.e. WC_Structured_Data::generate_product_data?

		} else {


			global $wp_query;
			/**
			 * Start Tutor Template
			 */

			if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'tutor_assignments'){
				if (is_user_logged_in()){
					$template = otlms_get_template( 'single-assignment' );
				}else{
					$template = otlms_get_template('login');
				}
				include_once $template;
				return;
			}

			/**
			 * End Tutor Template
			 */
		}

		wp_reset_query();

		global $oxy_vsb_use_query;

		if($oxy_vsb_use_query) {
			$oxy_vsb_use_query->reset_postdata();
		}
	}


	public function tutor_body_class($classes) {
		$classes[] = 'tutor';
		return $classes;
	}



	public function tutor_button_place() {
		return "single_template";
	}

}


new SingleAssignment();