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
        $add_to_cart_btn_selector1 = $price_selector.' .tutor-course-purchase-box button';
        $add_to_cart_btn_selector2 = $price_selector.' .tutor-course-purchase-box edd-add-to-cart';
        $add_to_cart_btn_selector = $add_to_cart_btn_selector1.', '.$add_to_cart_btn_selector2;
        $add_to_cart_btn->addStyleControls(
            array(
                array(
                    "name" => 'Font Size',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => 'Font Color',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => 'Font Family',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'font-family',
                ),
                array(
                    "name" => 'Background Color',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Border Color',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'border-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'border-radius',
                ),
                array(
                    "name" => 'Hover Background Color',
                    "selector" => $add_to_cart_btn_selector1.':hover, '.$add_to_cart_btn_selector2.':hover',
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Hover Border Color',
                    "selector" => $add_to_cart_btn_selector1.':hover, '.$add_to_cart_btn_selector2.':hover',
                    "property" => 'border-color',
                ),
            )
        );
        $add_to_cart_btn->addPreset(
            "padding",
            "add_to_cart_button_padding",
            __("Button Padding"),
            $add_to_cart_btn_selector
        );

        /* Enroll Button */
        $enroll_btn = $this->addControlSection("enroll_button", __("Enroll Button"), "assets/icon.png", $this);
        $enroll_btn_selector = $price_selector.' .tutor-btn-enroll';
        $enroll_btn->addStyleControls(
            array(
                array(
                    "name" => 'Font Size',
                    "selector" => $enroll_btn_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => 'Font Color',
                    "selector" => $enroll_btn_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => 'Font Family',
                    "selector" => $enroll_btn_selector,
                    "property" => 'font-family',
                ),
                array(
                    "name" => 'Background Color',
                    "selector" => $enroll_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Hover Background Color',
                    "selector" => $enroll_btn_selector.':hover',
                    "property" => 'background-color',
                ),
                array(
                    "name" => 'Border Color',
                    "selector" => $enroll_btn_selector,
                    "property" => 'border-color',
                ),
                array(
                    "name" => 'Hover Border Color',
                    "selector" => $enroll_btn_selector.':hover',
                    "property" => 'border-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $enroll_btn_selector,
                    "property" => 'border-radius',
                ),
            )
        );
        $enroll_btn->addPreset(
            "padding",
            "enroll_button_padding",
            __("Button Padding"),
            $enroll_btn_selector
        );
    }

}

new CourseEnrolmentBox();