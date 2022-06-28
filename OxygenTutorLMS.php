<?php

if ( ! defined( 'ABSPATH' ) )
	exit;

final class OxygenTutorLMS{

	/**
	 * @var null
	 */
	protected static $_instance = null;


	/**
	 * @return null|OxygenTutorLMS
	 *
	 * @since v.1.0.0
	 */

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {

		$this->admin_notice();
		if ( ! function_exists('tutor_lms') || ! class_exists('OxygenElement') ||  ! class_exists('OxyEl')){
			return;
		}

		add_filter('tutor_get_template_path', array($this, 'tutor_get_template_path'), 99, 2);

		$this->load_files();

		// Register +Add Tutor section
		add_action('oxygen_add_plus_sections', array($this, 'register_add_plus_section'));

		// Register +Add Tutor subsections
		// oxygen_add_plus_{$id}_section_content
		add_action('oxygen_add_plus_tutor_section_content', array($this, 'register_add_plus_subsections'));

		//Supporting public profile as author archive page
		add_action( 'pre_get_posts', array($this, 'public_profile_mark_archive'), 1 );

		add_action('template_redirect', array($this, 'logout_dashboard'), 99);
	}

	public function load_files(){
		/**
		 * Single Template
		 */
		include_once OTLMS_PATH.'functions.php';
		include_once OTLMS_PATH.'elements/OxygenTutorElements.php';
		include_once OTLMS_PATH.'elements/SingleCourse.php';
		include_once OTLMS_PATH.'elements/SingleLesson.php';
		include_once OTLMS_PATH.'elements/SingleQuiz.php';
		include_once OTLMS_PATH.'elements/SingleAssignment.php';
		include_once OTLMS_PATH.'elements/PublicProfile.php';

		/**
		 * Archive Courses
		 */
		include_once OTLMS_PATH.'elements/ArchiveCourse.php';
		include_once OTLMS_PATH.'elements/ArchiveCourseCategories.php';
		include_once OTLMS_PATH.'elements/CoursesList.php';

		/**
		 * Single Course Elements
		 */
		include_once OTLMS_PATH.'elements/CourseTitle.php';
		include_once OTLMS_PATH.'elements/CourseRating.php';
		include_once OTLMS_PATH.'elements/CourseAuthor.php';
		include_once OTLMS_PATH.'elements/CourseShare.php';
		include_once OTLMS_PATH.'elements/CourseCategories.php';
		//include_once OTLMS_PATH.'elements/CourseDuration.php';
		//include_once OTLMS_PATH.'elements/CourseTotalEnrolled.php';
		//include_once OTLMS_PATH.'elements/CourseLastUpdate.php';
		//include_once OTLMS_PATH.'elements/CourseStatus.php';
		include_once OTLMS_PATH.'elements/CourseAbout.php';
		include_once OTLMS_PATH.'elements/CourseDescription.php';
		include_once OTLMS_PATH.'elements/CourseCurriculum.php';
		include_once OTLMS_PATH.'elements/CourseBenefits.php';
		include_once OTLMS_PATH.'elements/CourseRequirements.php';
		include_once OTLMS_PATH.'elements/CourseTargetAudience.php';
		include_once OTLMS_PATH.'elements/CourseMaterial.php';
		include_once OTLMS_PATH.'elements/CourseThumbnail.php';
		include_once OTLMS_PATH.'elements/CourseEnrolmentBox.php';
		include_once OTLMS_PATH.'elements/CourseInstructors.php';
		include_once OTLMS_PATH.'elements/CourseReviews.php';

		/**
		 * TutorLMS Pages
		 */
		include_once OTLMS_PATH.'elements/PageStudentRegistration.php';
		include_once OTLMS_PATH.'elements/PageInstructorRegistration.php';
		include_once OTLMS_PATH.'elements/PageDashboard.php';



		/**
		 * Automatic include elements
		 */
		/*
		$elements = glob(OTLMS_PATH."elements/*.php");
		foreach ($elements as $element) {
			include_once $element;
		}*/
	}

	public function register_add_plus_section() {
		\CT_Toolbar::oxygen_add_plus_accordion_section("tutor",__("Tutor LMS", 'oxygen-tutor-lms'));
	}

	public function register_add_plus_subsections() { ?>

        <h2><?php _e("Single Template", 'oxygen-tutor-lms');?></h2>
		<?php do_action("oxygen_add_plus_tutor_single_template"); ?>

        <h2><?php _e("Single Course", 'oxygen-tutor-lms');?></h2>
		<?php do_action("oxygen_add_plus_tutor_single_course"); ?>

        <h2><?php _e("Archive & Course List", 'oxygen-tutor-lms');?></h2>
		<?php do_action("oxygen_add_plus_tutor_archive"); ?>

        <h2><?php _e("TutorLMS Pages", 'oxygen-tutor-lms');?></h2>
		<?php do_action("oxygen_add_plus_tutor_pages"); ?>

	<?php }


	public function tutor_get_template_path($template_location, $template){
		if ($template === 'single-preview-lesson'){
			$template_location = otlms_get_template( 'single-preview-lesson' );
		}
		return $template_location;
	}

	public function student_public_profile($template){
		global $wp_query;

		//die($template);
		//echo '<pre>';
		//print_r($wp_query);

		if ( ! empty($wp_query->query['tutor_student_username'])){
			$wp_query->is_author = true;
			//$template = otlms_get_template( 'student-public-profile' );
		}

		return $template;
	}


	/**
	 * @param $query
	 *
	 * @return mixed
	 *
	 * Marking Public profile Template as archive page
	 *
	 * @since v.1.0.0
	 */
	public function public_profile_mark_archive($query){
		global $wp_query;

		if ( ! is_admin() && ! empty($wp_query->query['tutor_student_username'])) {
			$author_name = sanitize_text_field($wp_query->query['tutor_student_username']);

			$query->is_archive           = true;
			$query->is_home              = false;
			$query->query['author_name'] = $author_name;
			$query->is_author            = true;
			$query->set( 'author_name', $author_name );
			$query->set( 'is_author', true );
		}

		return $query;
	}


	public function admin_notice(){
		if (defined('TUTOR_VERSION')){
			//Version Check
			if (version_compare(TUTOR_VERSION, '1.5.2', '<'  )){
				add_action( 'admin_notices', array($this, 'notice_required_tutor') );
			}
		}else{
			//Required Tutor Message
			add_action( 'admin_notices', array($this, 'notice_required_tutor') );
		}

		if ( ! class_exists('OxyEl')){
			//Required Oxygen Plugin
			add_action( 'admin_notices', array($this, 'notice_required_oxygen') );
		}

	}


	/**
	 * Notice for tutor lms plugin required
	 */
	public function notice_required_tutor(){
		$class = 'notice notice-warning';
		$message = __( 'In order to use Tutor LMS Oxygen Integration, you must have install and activated TutorLMS v.1.5.2', 'oxygen-tutor-lms' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	public function notice_required_oxygen(){
		$class = 'notice notice-warning';
		$message = __( 'In order to use Tutor LMS Oxygen Integration, you must have install and activated Oxygen Builder Plugin', 'oxygen-tutor-lms' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}


	public function logout_dashboard(){
		global $wp_query;
		$dashboard_page = tutor_utils()->array_get('tutor_dashboard_page', $wp_query->query_vars);
		if (is_user_logged_in()){
			if ( $dashboard_page && $dashboard_page === 'logout'){
				$dashboard_slug = $wp_query->query_vars['pagename'];
				$redirect = get_permalink( get_page_by_path( $dashboard_slug ) );

				wp_logout();
				wp_redirect($redirect);
				die();
			}
		}
	}

}