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
		if ( ! function_exists('tutor_lms') || ! class_exists('OxygenElement') ||  ! class_exists('OxyEl')){
			return;
		}

		add_filter('tutor_lms_should_template_override', '__return_false');
		add_filter('tutor_get_template_path', array($this, 'tutor_get_template_path'), 99, 2);

		$this->load_files();

		// Register +Add Tutor section
		add_action('oxygen_add_plus_sections', array($this, 'register_add_plus_section'));

		// Register +Add Tutor subsections
		// oxygen_add_plus_{$id}_section_content
		add_action('oxygen_add_plus_tutor_section_content', array($this, 'register_add_plus_subsections'));
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

		/**
		 * Archive Courses
		 */
		include_once OTLMS_PATH.'elements/ArchiveCourse.php';
		include_once OTLMS_PATH.'elements/CoursesList.php';

		/**
		 * Single Course Elements
		 */
		include_once OTLMS_PATH.'elements/CourseTitle.php';
		include_once OTLMS_PATH.'elements/CourseRating.php';
		include_once OTLMS_PATH.'elements/CourseAuthor.php';
		include_once OTLMS_PATH.'elements/CourseLevel.php';
		include_once OTLMS_PATH.'elements/CourseShare.php';
		include_once OTLMS_PATH.'elements/CourseCategories.php';
		include_once OTLMS_PATH.'elements/CourseDuration.php';
		include_once OTLMS_PATH.'elements/CourseTotalEnrolled.php';
		include_once OTLMS_PATH.'elements/CourseLastUpdate.php';

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

        <!--
		<h2><?php /*_e("Tutor Pages", 'oxygen-tutor-lms');*/?></h2>
		<?php /*do_action("oxygen_add_plus_tutor_pages"); */?>
        -->

		<h2><?php _e("Other Elements", 'oxygen-tutor-lms');?></h2>
		<?php do_action("oxygen_add_plus_tutor_other"); ?>

	<?php }


	public function tutor_get_template_path($template_location, $template){
	    if ($template === 'single-preview-lesson'){
		    $template_location = otlms_get_template( 'single-preview-lesson' );
	    }
        return $template_location;
    }

}