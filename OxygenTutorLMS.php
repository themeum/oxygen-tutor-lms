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
	
		$this->load_files();
	
	}

	public function load_files(){

		/**
		 * Automatic include elements
		 */
		$elements = glob(plugin_dir_path(__FILE__)."elements/*.php");
		foreach ($elements as $element) {
			include_once $element;
		}

/*
		include tutor()->path.'includes/integrations/oxygen/elements/OxygenTutorElements.php';
		include tutor()->path.'includes/integrations/oxygen/elements/CourseBuilder.php';
		*/
		
	}

}