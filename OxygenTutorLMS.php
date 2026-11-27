<?php
/**
 * Oxygen Tutor LMS
 *
 * @package OxygenTutorLMS
 * @author Themeum <support@themeum.com>
 * @link https://www.themeum.com/
 * @since 1.0.0
 */

use Tutor\Core\Input;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Oxygen Tutor LMS class.
 *
 * @since 1.0.0
 */
final class OxygenTutorLMS {

	/**
	 * Singleton instance.
	 *
	 * @var \OxygenTutorLMS|null
	 */
	protected static $instance = null;


	/**
	 * Return the singleton instance.
	 *
	 * @since 1.0.0
	 *
	 * @return \OxygenTutorLMS
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->admin_notice();
		if ( ! function_exists( 'tutor_lms' ) || ! class_exists( 'OxygenElement' ) || ! class_exists( 'OxyEl' ) ) {
			return;
		}

		add_action( 'init', array( $this, 'tutor_oxygen_init' ) );

		// Register +Add Tutor section.
		add_action( 'oxygen_add_plus_sections', array( $this, 'register_add_plus_section' ) );

		// Register +Add Tutor subsections
		// oxygen_add_plus_{$id}_section_content.
		add_action( 'oxygen_add_plus_tutor_section_content', array( $this, 'register_add_plus_subsections' ) );

		// Supporting public profile as author archive page.
		add_action( 'pre_get_posts', array( $this, 'public_profile_mark_archive' ), 1 );

		add_action( 'template_redirect', array( $this, 'allow_tutor_template' ) );

		add_filter( 'the_content', array( $this, 'load_default_tutor_pages' ) );

		// Preload Tutor lazy Alpine chunks in Oxygen Builder iframe before DOM hydration.
		add_action( 'wp_footer', array( $this, 'preload_dashboard_components_for_builder' ), 5 );
	}

	/**
	 * Load default tutor pages content if not builder content.
	 *
	 * @param string $content the content.
	 *
	 * @return string
	 */
	public function load_default_tutor_pages( $content ) {

		$ct_builder               = Input::get( 'ct_builder', false );
		$has_ct_builder_shortcode = get_post_meta( get_the_ID(), '_ct_builder_shortcodes', true );
		$has_ct_builder_json      = get_post_meta( get_the_ID(), '_ct_builder_json', true );
		if ( $ct_builder || ! empty( $has_ct_builder_json ) || ! empty( $has_ct_builder_shortcode ) ) {
			return $content;
		}

		$student_register_page_id    = (int) tutor_utils()->get_option( 'student_register_page' );
		$instructor_register_page_id = (int) tutor_utils()->get_option( 'instructor_register_page' );
		$cart_page_id                = (int) tutor_utils()->get_option( 'tutor_cart_page_id' );
		$checkout_page_id            = (int) tutor_utils()->get_option( 'tutor_checkout_page_id' );
		$monetize_by                 = tutor_utils()->get_option( 'monetize_by' );

		if ( get_the_ID() === $student_register_page_id ) {
			return do_shortcode( '[tutor_student_registration_form]' );
		}

		if ( get_the_ID() === $instructor_register_page_id ) {
			return do_shortcode( '[tutor_instructor_registration_form]' );
		}

		if ( 'tutor' === $monetize_by ) {
			if ( get_the_ID() === $cart_page_id ) {
				return ( new \Tutor\Shortcode( false ) )->tutor_cart_page();
			}

			if ( get_the_ID() === $checkout_page_id ) {
				if ( ! apply_filters( 'tutor_should_load_checkout_page', true ) ) {
					return '';
				}

				return ( new \Tutor\Shortcode( false ) )->tutor_checkout_page();
			}
		}
		return $content;
	}

	/**
	 * Allow tutor template.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function allow_tutor_template() {
		$is_dashboard_page        = tutor_utils()->is_dashboard_page();
		$is_learning_area         = tutor_utils()->is_learning_area() && ! tutor_utils()->is_legacy_learning_mode();
		$ct_builder               = Input::get( 'ct_builder', false );
		$has_ct_builder_shortcode = get_post_meta( get_the_ID(), '_ct_builder_shortcodes', true );
		$has_ct_builder_json      = get_post_meta( get_the_ID(), '_ct_builder_json', true );
		if ( $ct_builder || ! empty( $has_ct_builder_json ) || ! empty( $has_ct_builder_shortcode ) ) {
			return;
		}

		if ( $is_dashboard_page || $is_learning_area ) {
			remove_filter( 'tutor_lms_should_template_override', '__return_false' );
			new \TUTOR\Template();
			add_filter( 'tutor_lms_should_template_override', '__return_false' );
		}
	}

	/**
	 * Load files.
	 *
	 * @since 1.0.0
	 */
	public function load_files() {
		/**
		 * Single Template
		 */
		include_once OTLMS_PATH . 'functions.php';
		include_once OTLMS_PATH . 'elements/OxygenTutorElements.php';
		include_once OTLMS_PATH . 'elements/SingleCourse.php';
		include_once OTLMS_PATH . 'elements/SingleLesson.php';
		include_once OTLMS_PATH . 'elements/SingleQuiz.php';
		include_once OTLMS_PATH . 'elements/SingleAssignment.php';
		include_once OTLMS_PATH . 'elements/PublicProfile.php';

		/**
		 * Archive Courses
		 */
		include_once OTLMS_PATH . 'elements/ArchiveCourse.php';
		include_once OTLMS_PATH . 'elements/CoursesList.php';

		/**
		 * Single Course Elements
		 */
		include_once OTLMS_PATH . 'elements/CourseTitle.php';
		include_once OTLMS_PATH . 'elements/CourseRating.php';
		include_once OTLMS_PATH . 'elements/CourseAuthor.php';
		include_once OTLMS_PATH . 'elements/CourseShare.php';
		include_once OTLMS_PATH . 'elements/CourseCategories.php';
		include_once OTLMS_PATH . 'elements/CourseAbout.php';
		include_once OTLMS_PATH . 'elements/CourseDescription.php';
		include_once OTLMS_PATH . 'elements/CourseCurriculum.php';
		include_once OTLMS_PATH . 'elements/CourseBenefits.php';
		include_once OTLMS_PATH . 'elements/CourseRequirements.php';
		include_once OTLMS_PATH . 'elements/CourseTargetAudience.php';
		include_once OTLMS_PATH . 'elements/CourseMaterial.php';
		include_once OTLMS_PATH . 'elements/CourseThumbnail.php';
		include_once OTLMS_PATH . 'elements/CourseEnrolmentBox.php';
		include_once OTLMS_PATH . 'elements/CourseInstructors.php';
		include_once OTLMS_PATH . 'elements/CourseReviews.php';

		/**
		 * TutorLMS Pages
		 */
		include_once OTLMS_PATH . 'elements/PageStudentRegistration.php';
		include_once OTLMS_PATH . 'elements/PageInstructorRegistration.php';
		include_once OTLMS_PATH . 'elements/PageDashboard.php';
	}


	/**
	 * Load text domain
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function tutor_oxygen_init() {
		load_plugin_textdomain( 'oxygen-tutor-lms', false, basename( __DIR__ ) . '/languages' );
		$this->load_files();
	}

	/**
	 * Register +Add Tutor section.
	 *
	 * @since 1.0.0
	 */
	public function register_add_plus_section() {
		\CT_Toolbar::oxygen_add_plus_accordion_section( 'tutor', __( 'Tutor LMS', 'oxygen-tutor-lms' ) );
	}

	/**
	 * Register +Add Tutor subsections.
	 *
	 * @since 1.0.0
	 */
	public function register_add_plus_subsections() {
		?>

		<h2><?php esc_html_e( 'Single Template', 'oxygen-tutor-lms' ); ?></h2>
		<?php do_action( 'oxygen_add_plus_tutor_single_template' ); ?>

		<h2><?php esc_html_e( 'Single Course', 'oxygen-tutor-lms' ); ?></h2>
		<?php do_action( 'oxygen_add_plus_tutor_single_course' ); ?>

		<h2><?php esc_html_e( 'Archive & Course List', 'oxygen-tutor-lms' ); ?></h2>
		<?php do_action( 'oxygen_add_plus_tutor_archive' ); ?>

		<h2><?php esc_html_e( 'TutorLMS Pages', 'oxygen-tutor-lms' ); ?></h2>
		<?php do_action( 'oxygen_add_plus_tutor_pages' ); ?>

		<?php
	}

	/**
	 * Student public profile.
	 *
	 * @since 1.0.0
	 *
	 * @param string $template the template.
	 *
	 * @return string
	 */
	public function student_public_profile( $template ) {
		global $wp_query;

		if ( ! empty( $wp_query->query['tutor_student_username'] ) ) {
			$wp_query->is_author = true;
		}

		return $template;
	}


	/**
	 * Marking Public profile Template as archive page.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_Query $query the query object.
	 *
	 * @return mixed
	 */
	public function public_profile_mark_archive( $query ) {
		global $wp_query;

		if ( ! is_admin() && ! empty( $wp_query->query['tutor_student_username'] ) ) {
			$author_name = sanitize_text_field( $wp_query->query['tutor_student_username'] );

			$query->is_archive           = true;
			$query->is_home              = false;
			$query->query['author_name'] = $author_name;
			$query->is_author            = true;
			$query->set( 'author_name', $author_name );
			$query->set( 'is_author', true );
		}

		return $query;
	}

	/**
	 * Admin notice.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function admin_notice() {
		if ( defined( 'TUTOR_VERSION' ) ) {
			// Version Check.
			if ( version_compare( TUTOR_VERSION, '2.1.0', '<' ) ) {
				add_action( 'admin_notices', array( $this, 'notice_required_tutor' ) );
			}
		} else {
			// Required Tutor Message.
			add_action( 'admin_notices', array( $this, 'notice_required_tutor' ) );
		}

		if ( ! class_exists( 'OxyEl' ) ) {
			// Required Oxygen Plugin.
			add_action( 'admin_notices', array( $this, 'notice_required_oxygen' ) );
		}
	}

	/**
	 * Notice for tutor lms plugin required.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function notice_required_tutor() {
		$class   = 'notice notice-warning';
		$message = __( 'In order to use Tutor LMS Oxygen Integration, you must have install and activated TutorLMS v.2.1.0', 'oxygen-tutor-lms' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Notice for oxygen plugin required.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function notice_required_oxygen() {
		$class   = 'notice notice-warning';
		$message = __( 'In order to use Tutor LMS Oxygen Integration, you must have install and activated Oxygen Builder Plugin', 'oxygen-tutor-lms' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Preload Tutor lazy Alpine components inside the Oxygen Builder iframe.
	 *
	 * Oxygen renders elements asynchronously via AJAX after DOMContentLoaded, so
	 * tutor-core.js initially scans an empty #ct-builder container and skips loading
	 * lazy chunks such as tutor-form.js and tutor-calendar.js before Alpine.start().
	 *
	 * @since 4.0.1
	 *
	 * @return void
	 */
	public function preload_dashboard_components_for_builder() {
		if ( ! defined( 'OXYGEN_IFRAME' ) || ! OXYGEN_IFRAME ) {
			return;
		}

		if ( ! wp_script_is( 'tutor-core', 'enqueued' ) && ! wp_script_is( 'tutor-core', 'done' ) ) {
			return;
		}

		if ( ! tutor_utils()->is_dashboard_page() ) {
			return;
		}
		?>
		<template id="otlms-tutor-components-preload" x-ignore aria-hidden="true">
			<div x-data="tutorForm"></div>
			<div x-data="tutorCalendar"></div>
			<div x-data="tutorFileUploader"></div>
			<div x-data="tutorSelect"></div>
			<div x-data="tutorTimeInput"></div>
		</template>
		<?php
	}
}