<?php
namespace Oxygen\TutorElements;

use TUTOR\Shortcode;

class PageDashboard extends \OxygenTutorElements {

	function name() {
		return 'Dashboard';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		/**
		 * Start Tutor Template
		 */
		global $wp_query;

		ob_start();
		if (is_user_logged_in()){
			tutor_load_template( 'dashboard.index' );
		}else{
			tutor_load_template( 'global.login' );
		}
		echo apply_filters( 'tutor_dashboard/index', ob_get_clean() );

		/**
		 * End Tutor Template
		 */
	}

	function tutor_button_place() {
		return "pages";
	}

	function controls() {
		$selector = '.tutor-dashboard';
		$header_selector = $selector.' .tutor-dashboard-header';
		$menu_selector = $selector.' .tutor-dashboard-permalinks';
		$menu_item_selector = $menu_selector.' li a';
		$menu_item_selector_hover = $menu_selector.' li a:hover';
		$menu_item_selector_active = $menu_selector.' li.active a';

		/* Menu item */
		$header = $this->addControlSection("dashboard_header", __("Header"), "assets/icon.png", $this);
		$img_selector = $header_selector.' .tutor-dashboard-header-avatar img';
		$header_img = $header->addControlSection("dashboard_header_img", __("Image"), "assets/icon.png", $this);
		$header_img->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => $img_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width'),
                	"selector" => $img_selector,
					"property" => 'width',
				)
			)
		);
		$header->typographySection(__('Display Name'), $header_selector.' .tutor-dashboard-header-display-name h4', $this);

		$header_stars = $header->addControlSection("dashboard_header_stars", __("Rating Stars"), "assets/icon.png", $this);
        $stars_selector = $header_selector." .tutor-star-rating-group";
        $header_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color'),
                    "selector" => $stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size'),
                    "selector" => $stars_selector,
                    "property" => 'font-size',
                )
            )
		);

		$header->typographySection(__('Rating Text'), $header_selector." .tutor-dashboard-header-ratings span", $this);

		$new_course_btn = $this->addControlSection("new_course_btn", __("Header Button"), "assets/icon.png", $this);
        $new_course_btn_selector = $header_selector.' .tutor-dashboard-header-button a';
        $new_course_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings"),
            $new_course_btn_selector
        );
        $new_course_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $new_course_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Background Color'),
                    "selector" => $new_course_btn_selector.':hover',
                    "property" => 'background-color',
                )
            )
        );
        $new_course_btn->typographySection(__("Typography"), $new_course_btn_selector, $this);
        $new_course_btn->borderSection(__("Borders"), $new_course_btn_selector, $this);
        $new_course_btn->borderSection(__("Hover Borders"), $new_course_btn_selector.":hover", $this);
        $new_course_btn->boxShadowSection(__("Shadow"), $new_course_btn_selector, $this);
        $new_course_btn->boxShadowSection(__("Hover Shadow"), $new_course_btn_selector.":hover", $this);


		/* Menu item */
		$menu = $this->addControlSection("menu", __("Menu"), "assets/icon.png", $this);
		$menu_item = $menu->addControlSection("menu_item", __("Item"), "assets/icon.png", $this);
		$menu_item->addStyleControls(
			array(
				array(
					"name"		=> __('Icon Color'),
					"selector" 	=> $menu_item_selector.':before',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size'),
					"selector" 	=> $menu_item_selector.':before',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'background-color',
				),
			)
		);

		/* Menu item Hover */
		$menu_item_hover = $menu->addControlSection("menu_item_hover", __("Item Hover"), "assets/icon.png", $this);
		$menu_item_hover->addStyleControls(
			array(
				array(
					"name"		=> __('Icon Color'),
					"selector" 	=> $menu_item_selector_hover.':before',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size'),
					"selector" 	=> $menu_item_selector_hover.':before',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'background-color',
				),
			)
		);

		/* Menu item Active */
		$menu_item_active = $menu->addControlSection("menu_item_active", __("Item Active"), "assets/icon.png", $this);
		$menu_item_active->addStyleControls(
			array(
				array(
					"name"		=> __('Icon Color'),
					"selector" 	=> $menu_item_selector_active.':before',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size'),
					"selector" 	=> $menu_item_selector_active.':before',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'background-color',
				),
			)
		);
		/* Menu spacing */
		$menu_spacing = $menu->addControlSection("menu_item_spacing", __("Spacing"), "assets/icon.png", $this);
		$menu_spacing->addPreset("padding", "menu_item_padding", __("Padding"), $menu_item_selector);
		$menu_spacing->addPreset("margin", "menu_item_margin", __("Margin"), $menu_item_selector);

		$this->typographySection(__("Title"), $selector.' .tutor-dashboard-content h3', $this);
		$this->typographySection(__("Links"), $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner a', $this);
		$this->typographySection(__("Links Hover"), $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner a:hover', $this);

		/* Info card */
		$info_card_selector =  $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner .tutor-dashboard-info-card';
		$info_card = $this->addControlSection("info_card", __("Info Card"), "assets/icon.png", $this);
		$info_card->typographySection(__("Label"), $info_card_selector.' p span:first-child', $this);
		$info_card->typographySection(__("Value"), $info_card_selector.' p span.tutor-dashboard-info-val', $this);
		$info_card_background = $info_card->addControlSection("info_card_color", __("Background"), "assets/icon.png", $this);
		$info_card_background->addStyleControls(
			array(
				array(
					"name"		=> __('Color'),
					"selector" 	=> $info_card_selector.' p',
					"property" 	=> 'background-color',
				),
			)
		);
		$info_card_spacing = $info_card->addControlSection("info_card_spacing", __("Spacing"), "assets/icon.png", $this);
		$info_card_spacing->addPreset("padding", "info_card_padding", __("Padding"), $info_card_selector);
		$info_card_spacing->addPreset("margin", "info_card_margin", __("Margin"), $info_card_selector);
	}
}


new PageDashboard();