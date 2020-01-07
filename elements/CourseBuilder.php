<?php
namespace Oxygen\TutorElements;

class CourseBuilder extends \OxygenTutorElements {

	function name() {
		return 'Course Builder';
	}


	function render($options, $defaults, $content) {
		global $post;

		$course_post_type = tutor()->course_post_type;

		// add body class
		add_filter('body_class', array($this, "tutor_body_class"));
		/*
				if (isset($options['product_id']) && $options['product_id']) {

					$override_product = wc_get_product($options['product_id']);

					if ($override_product) {
						$product = $override_product;

						// update global post
						$post = get_post($options['product_id']);
						setup_postdata( $post );

						// enqueue woo gallery scripts
						// taken from WC_Frontend_Scripts::load_scripts
						if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
							wp_enqueue_script( 'zoom' );
						}
						if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
							wp_enqueue_script( 'flexslider' );
						}
						if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
							wp_enqueue_script( 'photoswipe-ui-default' );
							wp_enqueue_style( 'photoswipe-default-skin' );
							add_action( 'wp_footer', 'woocommerce_photoswipe' );
						}
						wp_enqueue_script( 'wc-single-product' );
					}

				}*/


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

			$template = '';

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
		return "single_course";
	}

}


new CourseBuilder();