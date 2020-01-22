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
        
        if (is_user_logged_in() && tutils()->is_enrolled()) {
            include_once otlms_get_template('course/enrolled-box');
        } else {
            include_once otlms_get_template('course/enrolment-box');
        }
    }

    function class_names() {
        return array('tutor-course-enrolment-box', 'oxy-tutor-element');
    }

    function controls() {

        /* Price */
        $price_selector = ".tutor-price-preview-box";
        $this->typographySection('Price', $price_selector.' .price, '.$price_selector.' .price .woocommerce-Price-amount', $this);

        /* Add to Cart Button */
        $add_to_cart_btn = $this->addControlSection("add_to_cart_btn", __("Add to Cart Button"), "assets/icon.png", $this);
        $add_to_cart_btn_selector = '.tutor-course-purchase-box button, .tutor-course-purchase-box edd-add-to-cart';

        $add_to_cart_btn->addPreset(
            "padding",
            "button_padding",
            __("Button Paddings"),
            $add_to_cart_btn_selector
        );
        $add_to_cart_btn->addStyleControls(
            array(
                array(
                    "name" => 'Button Background Color',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Button Hover Background Color',
                    "selector" => $add_to_cart_btn_selector.':hover',
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'border-radius',
                ),
            )
        );
        $add_to_cart_btn->typographySection(
            __("Button Typography"),
            $add_to_cart_btn_selector,
            $this);

        /* Enroll Button */
        $enroll_btn = $this->addControlSection("enroll_button", __("Enroll Button"), "assets/icon.png", $this);
        $enroll_btn_selector = $price_selector.' .tutor-btn-enroll';

        $enroll_btn->addPreset(
            "padding",
            "button_padding",
            __("Button Paddings"),
            $enroll_btn_selector
        );
        $enroll_btn->addStyleControls(
            array(
                array(
                    "name" => 'Button Background Color',
                    "selector" => $enroll_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Button Hover Background Color',
                    "selector" => $enroll_btn_selector.':hover',
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $enroll_btn_selector,
                    "property" => 'border-radius',
                ),
            )
        );
        $enroll_btn->typographySection(
            __("Button Typography"),
            $enroll_btn_selector,
            $this);
    }

}

new CourseEnrolmentBox();