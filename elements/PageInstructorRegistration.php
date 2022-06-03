<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageInstructorRegistration extends \OxygenTutorElements {

	function name() {
		return 'Instructor Registration';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		/**
		 * Start Tutor Template
		 */

		$template = otlms_get_template('instructor-registration');

		include_once( $template );

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "pages";
	}

	function controls() {
		$selector = '.tutor-instructor-registration';
		$student_registration = $this->addControlSection("student-registration", __("Registration Form"), "assets/icon.png", $this);
		$student_registration->typographySection(__('Label'), $selector.' .tutor-form-group label', $this);
		$student_registration->typographySection(__('Input Typography'), $selector.' .tutor-form-group input', $this);
		$input_settings = $student_registration->addControlSection("input-settins", __("Input Field"), "assets/icon.png", $this);
		$input_selector = $selector." .tutor-form-group input";
		$input_settings->addStyleControls(
			array(
				array(
                	"name" => __('Background Color'),
                	"selector" => $input_selector,
					"property" => 'background-color',
				),
				array(
                	"name" => __('Height'),
                	"selector" => $input_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Line Height'),
                	"selector" => $input_selector,
					"property" => 'line-height',
				),
				array(
                	"name" => __('Border Color'),
                	"selector" => $input_selector,
					"property" => 'border-color',
				),
				array(
                	"name" => __('Border Width'),
                	"selector" => $input_selector,
					"property" => 'border-width',
				)
			)
		);


		/* Register Button */
        $register_btn = $this->addControlSection("enroll_button", __("Register Button"), "assets/icon.png", $this);
        $register_btn_selector = $selector.' .tutor-btn-primary';
        $register_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $register_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color'),
                    "selector" => $register_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $register_btn_selector.":hover",
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Color'),
                    "selector" => $register_btn_selector.":hover",
                    "property" => 'color',
                )
            )
        );
        $register_btn->addPreset("padding", "submit_padding",  __("Button Paddings"), $register_btn_selector);
        $register_btn->typographySection(__("Typography"), $register_btn_selector, $this);
        $register_btn->borderSection(__("Borders"), $register_btn_selector, $this);
        $register_btn->borderSection(__("Hover Borders"), $register_btn_selector.":hover", $this);
        $register_btn->boxShadowSection(__("Shadow"), $register_btn_selector, $this);
        $register_btn->boxShadowSection(__("Hover Shadow"), $register_btn_selector.":hover", $this);
	}

}


new PageInstructorRegistration();