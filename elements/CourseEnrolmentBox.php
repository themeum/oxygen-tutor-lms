<?php
namespace Oxygen\TutorElements;

class CourseEnrolmentBox extends \OxygenTutorElements {

	function name() {
        return 'Enrolment Box';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        include_once otlms_get_template('course/enrolment-box');
    }

    function class_names() {
        return array('tutor-course-enrolment-box', 'oxy-tutor-element');
    }

    function controls() {

        $selector = '.tutor-single-course-sidebar';

        /* Course enrollment box */
		$enrollment_box_selector = $selector." .tutor-sidebar-card";
		$course_enrollment_box = $this->addControlSection("enrollment_box", __("Enrollment Box","oxygen-tutor-lms"), "assets/icon.png", $this);
        $course_enrollment_box->borderSection(__("Borders","oxygen-tutor-lms"), $enrollment_box_selector, $this);
        $course_enrollment_box->typographySection(__('Course Price','oxygen-tutor-lms'), $enrollment_box_selector.' .tutor-course-single-pricing span', $this);
        
        $course_enrollment_box->typographySection(__('Course Progress Title','oxygen-tutor-lms'), $enrollment_box_selector.' .tutor-course-progress-wrapper h3', $this);
        $course_enrollment_box->typographySection(__('Course Progress Text','oxygen-tutor-lms'), $enrollment_box_selector.' .list-item-progress span', $this);
        $course_progress_bar_main_selector = $enrollment_box_selector.' .tutor-progress-bar';
        $course_progress_bar_fill_selector = $course_progress_bar_main_selector.' .tutor-progress-value';
        $course_progress_bar = $course_enrollment_box->addControlSection("course_progress_bar_main", __("Course Progress Bar","oxygen-tutor-lms"), "assets/icon.png", $this);
        $course_progress_bar->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $course_progress_bar_main_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Fill Color','oxygen-tutor-lms'),
                    "selector" => $course_progress_bar_main_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Height','oxygen-tutor-lms'),
                    "selector" => $course_progress_bar_main_selector.', '.$course_progress_bar_fill_selector,
                    "property" => 'height',
                )
            )
        );
		
		/* Add to Cart & Enroll Button */
        $add_to_cart_btn = $this->addControlSection("add_to_cart_btn", __("Cart & Enroll Button","oxygen-tutor-lms"), "assets/icon.png", $this);
        $add_to_cart_btn_selector1 = $enrollment_box_selector.' .tutor-btn-primary';
        $add_to_cart_btn_selector2 = $enrollment_box_selector.' .tutor-btn-primary';
        $add_to_cart_btn_selector = $add_to_cart_btn_selector1.', '.$add_to_cart_btn_selector2;
        $add_to_cart_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings","oxygen-tutor-lms"),
            $add_to_cart_btn_selector
        );
        $add_to_cart_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" =>__('Hover Background Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector1.':hover, '.$add_to_cart_btn_selector2.':hover',
                    "property" => 'background-color',
                )
            )
        );
        $add_to_cart_btn->typographySection(__("Typography","oxygen-tutor-lms"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->borderSection(__("Borders","oxygen-tutor-lms"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->borderSection(__("Hover Borders","oxygen-tutor-lms"), $add_to_cart_btn_selector.":hover", $this);
        $add_to_cart_btn->boxShadowSection(__("Shadow","oxygen-tutor-lms"), $add_to_cart_btn_selector, $this);
        $add_to_cart_btn->boxShadowSection(__("Hover Shadow","oxygen-tutor-lms"), $add_to_cart_btn_selector.":hover", $this);

        /* Certificate & Retake */
        $enroll_btn = $this->addControlSection("enroll_button", __("Certificate & Retake Button","oxygen-tutor-lms"), "assets/icon.png", $this);
        $enroll_btn_selector = $enrollment_box_selector.' .tutor-btn-outline-primary';
        $enroll_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings","oxygen-tutor-lms"),
            $enroll_btn_selector
        );
        $enroll_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color','oxygen-tutor-lms'),
                    "selector" => $enroll_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $enroll_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Hover Background Color','oxygen-tutor-lms'),
                    "selector" => $enroll_btn_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );
        $enroll_btn->typographySection(__("Typography","oxygen-tutor-lms"), $enroll_btn_selector, $this);
        $enroll_btn->borderSection(__("Borders","oxygen-tutor-lms"), $enroll_btn_selector, $this);
        $enroll_btn->borderSection(__("Hover Borders","oxygen-tutor-lms"), $enroll_btn_selector.":hover", $this);
        $enroll_btn->boxShadowSection(__("Shadow","oxygen-tutor-lms"), $enroll_btn_selector, $this);
        $enroll_btn->boxShadowSection(__("Hover Shadow","oxygen-tutor-lms"), $enroll_btn_selector.":hover", $this);

        /* Course Info */
        $course_info = $this->addControlSection("course_information", __("Course Information","oxygen-tutor-lms"), "assets/icon.png", $this);
        $course_info_selector = $enrollment_box_selector.' .tutor-card-footer';
        $course_info->typographySection(__('Course Information Text','oxygen-tutor-lms'), $course_info_selector.' .tutor-color-secondary', $this);
        $course_info->typographySection(__('Course Information Icon','oxygen-tutor-lms'), $course_info_selector.' .tutor-color-black', $this);

    }
}

new CourseEnrolmentBox();