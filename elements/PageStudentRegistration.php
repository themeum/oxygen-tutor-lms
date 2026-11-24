<?php
namespace Oxygen\TutorElements;

class PageStudentRegistration extends \OxygenTutorElements {

	function name() {
		return 'Student Registration';
	}

	function icon() {
		return plugin_dir_url( OTLMS_FILE ) . 'assets/icons/' . basename( __FILE__, '.php' ) . '.svg';
	}

	function render( $options, $defaults, $content ) {
		/**
		 * Start Tutor Template
		 */

		$template     = '';
		$is_logged_in = is_user_logged_in() ? 'logged_in' : 'logged_out';
		$preview_mode = isset( $options['preview_mode'] ) ? $options['preview_mode'] : $is_logged_in;
		$is_builder   = defined( 'SHOW_CT_BUILDER' )
		|| defined( 'OXYGEN_IFRAME' )
		|| defined( 'OXY_ELEMENTS_API_AJAX' )
		|| ( class_exists( '\Tutor\Core\Input' ) && \Tutor\Core\Input::get( 'ct_builder', false ) );

		if ( $is_builder ) {
			if ( 'logged_in' === $preview_mode ) {
				$template = tutor_get_template( 'dashboard.logged-in' );
			} else {
				$template = otlms_get_template( 'student-registration' );
			}
		} elseif ( 'logged_in' === $is_logged_in ) {
			$template = tutor_get_template( 'dashboard.logged-in' );
		} else {
			$template = otlms_get_template( 'student-registration' );
		}

		include_once $template;

		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return 'pages';
	}

	function controls() {
		$selector             = '#tutor-registration-form';
		$student_registration = $this->addControlSection( 'student-registration', __( 'Registration Form' ), 'assets/icon.png', $this );
		$student_registration->typographySection( __( 'Input Label', 'oxygen-tutor-lms' ), $selector . ' .tutor-input-field label', $this );
		$student_registration->typographySection( __( 'Input Typography', 'oxygen-tutor-lms' ), $selector . ' .tutor-input-field input', $this );
		$input_settings = $student_registration->addControlSection( 'input-settings', __( 'Input Field' ), 'assets/icon.png', $this );
		$input_selector = $selector . ' .tutor-input-field input';
		$input_settings->addStyleControls(
			array(
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $input_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Height', 'oxygen-tutor-lms' ),
					'selector' => $input_selector,
					'property' => 'height',
				),
				array(
					'name'     => __( 'Line Height', 'oxygen-tutor-lms' ),
					'selector' => $input_selector,
					'property' => 'line-height',
				),
				array(
					'name'     => __( 'Border Color', 'oxygen-tutor-lms' ),
					'selector' => $input_selector,
					'property' => 'border-color',
				),
				array(
					'name'     => __( 'Border Width', 'oxygen-tutor-lms' ),
					'selector' => $input_selector,
					'property' => 'border-width',
				),
			)
		);

		/* Preview Mode */
		$preview_mode = $this->addOptionControl(
			array(
				'type' => 'buttons-list',
				'name' => __( 'Preview State', 'oxygen-tutor-lms' ),
				'slug' => 'preview_mode',
			)
		);

		$preview_mode->setValue(
			array(
				'logged_out' => __( 'Logged Out', 'oxygen-tutor-lms' ),
				'logged_in'  => __( 'Logged In', 'oxygen-tutor-lms' ),
			)
		);

		$preview_mode->setDefaultValue( 'logged_out' );
		$preview_mode->rebuildElementOnChange();

		/* Register Button */
		$register_btn          = $this->addControlSection( 'enroll_button', __( 'Register Button', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$register_btn_selector = $selector . ' .tutor-btn-primary';
		$register_btn->addStyleControls(
			array(
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $register_btn_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Color', 'oxygen-tutor-lms' ),
					'selector' => $register_btn_selector,
					'property' => 'color',
				),
				array(
					'name'     => __( 'Hover Background Color', 'oxygen-tutor-lms' ),
					'selector' => $register_btn_selector . ':hover',
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Hover Color', 'oxygen-tutor-lms' ),
					'selector' => $register_btn_selector . ':hover',
					'property' => 'color',
				),
			)
		);
		$register_btn->addPreset( 'padding', 'submit_padding', __( 'Button Paddings', 'oxygen-tutor-lms' ), $register_btn_selector );
		$register_btn->typographySection( __( 'Typography', 'oxygen-tutor-lms' ), $register_btn_selector, $this );
		$register_btn->borderSection( __( 'Borders', 'oxygen-tutor-lms' ), $register_btn_selector, $this );
		$register_btn->borderSection( __( 'Hover Borders', 'oxygen-tutor-lms' ), $register_btn_selector . ':hover', $this );
		$register_btn->boxShadowSection( __( 'Shadow', 'oxygen-tutor-lms' ), $register_btn_selector, $this );
		$register_btn->boxShadowSection( __( 'Hover Shadow', 'oxygen-tutor-lms' ), $register_btn_selector . ':hover', $this );
	}
}


new PageStudentRegistration();
