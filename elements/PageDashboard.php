<?php
namespace Oxygen\TutorElements;

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
		$dashboard_page = tutor_utils()->array_get('tutor_dashboard_page', $wp_query->query_vars);

		if($dashboard_page === 'create-course') {
			return;
		}
		
		$get_dashboard_config = tutils()->tutor_dashboard_permalinks();
		$target_dashboard_page = tutils()->array_get($dashboard_page, $get_dashboard_config);
		$template = otlms_get_template('retrieve-password');
		if (isset($target_dashboard_page['login_require']) && $target_dashboard_page['login_require'] === false){
			$template = otlms_get_template('retrieve-password');
		} else {
			if (is_user_logged_in()){
				$template = otlms_get_template('dashboard');
			}else{
				$template = otlms_get_template('login');
			}
		}
		
		ob_start();
		/**
		 * Tutor template load function removed cause it had been called multiple times
		 * & thus template was loading multiple times
		 * to fix added include_once
		 * @since version 1.0.3
		 */
		include_once( $template );
		
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
		$header_selector = $selector.' .tutor-frontend-dashboard-header';
		$menu_selector = $selector.' .tutor-dashboard-permalinks';
		$menu_item_selector = $menu_selector.' .tutor-dashboard-menu-item a';
		$menu_item_selector_hover = $menu_selector.' .tutor-dashboard-menu-item a:hover';
		$menu_item_selector_active = $menu_selector.' .tutor-dashboard-menu-item.active a';

		/* Menu item */
		$header = $this->addControlSection("dashboard_header", __("Header"), "assets/icon.png", $this);
		$img_selector = $header_selector.' .tutor-avatar';
		$header_img = $header->addControlSection("dashboard_header_img", __("Image"), "assets/icon.png", $this);
		$header_img->addStyleControls(
			array(
				array(
                	"name" => __('Height','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'height',
				),
				array(
                	"name" => __('Width','oxygen-tutor-lms'),
                	"selector" => $img_selector,
					"property" => 'width',
				)
			)
		);
		$header->typographySection(__('Display Name','oxygen-tutor-lms'), $header_selector.' .tutor-dashboard-header-username', $this);

		$header_stars = $header->addControlSection("dashboard_header_stars", __("Rating Stars","oxygen-tutor-lms"), "assets/icon.png", $this);
        $stars_selector = $header_selector." .tutor-ratings-stars span";
        $header_stars->addStyleControls(
            array(
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $stars_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => __('Size','oxygen-tutor-lms'),
                    "selector" => $stars_selector,
                    "property" => 'font-size',
                )
            )
		);

		$header->typographySection(__('Rating Average','oxygen-tutor-lms'), $header_selector." .tutor-ratings-average", $this);
		$header->typographySection(__('Rating Count','oxygen-tutor-lms'), $header_selector." .tutor-ratings-count", $this);

		$new_course_btn = $this->addControlSection("new_course_btn", __("Header Button","oxygen-tutor-lms"), "assets/icon.png", $this);
        $new_course_btn_selector = $header_selector.' .tutor-btn-outline-primary';
        $new_course_btn->addPreset( "padding", "submit_padding", __("Button Paddings","oxygen-tutor-lms"), $new_course_btn_selector);
        $new_course_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color','oxygen-tutor-lms'),
                    "selector" => $new_course_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Hover Background Color','oxygen-tutor-lms'),
                    "selector" => $new_course_btn_selector.':hover',
                    "property" => 'background-color',
				),
				array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $new_course_btn_selector,
                    "property" => 'color',
                ),
				array(
                    "name" => __('Hover Color','oxygen-tutor-lms'),
                    "selector" => $new_course_btn_selector.':hover',
                    "property" => 'color',
                )
            )
        );
        $new_course_btn->typographySection(__("Typography","oxygen-tutor-lms"), $new_course_btn_selector, $this);
        $new_course_btn->borderSection(__("Borders","oxygen-tutor-lms"), $new_course_btn_selector, $this);
        $new_course_btn->borderSection(__("Hover Borders","oxygen-tutor-lms"), $new_course_btn_selector.":hover", $this);
        $new_course_btn->boxShadowSection(__("Shadow","oxygen-tutor-lms"), $new_course_btn_selector, $this);
        $new_course_btn->boxShadowSection(__("Hover Shadow","oxygen-tutor-lms"), $new_course_btn_selector.":hover", $this);


		/* Menu item */
		$menu = $this->addControlSection("menu", __("Menu"), "assets/icon.png", $this);
		$menu_item = $menu->addControlSection("menu_item", __("Item"), "assets/icon.png", $this);
		$menu_item->addStyleControls(
			array(
				array(
					"name"		=> __('Icon Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color','oxygen-tutor-lms'),
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
					"name"		=> __('Icon Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_hover.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_hover.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_hover,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color','oxygen-tutor-lms'),
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
					"name"		=> __('Icon Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Icon Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active.' .tutor-dashboard-menu-item-icon',
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'color',
				),
				array(
					"name"		=> __('Font Size','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'font-size',
				),
				array(
					"name"		=> __('Font Family','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'font-family',
				),
				array(
					"name"		=> __('Background Color','oxygen-tutor-lms'),
					"selector" 	=> $menu_item_selector_active,
					"property" 	=> 'background-color',
				),
			)
		);
		/* Menu spacing */
		$menu_spacing = $menu->addControlSection("menu_item_spacing", __("Spacing"), "assets/icon.png", $this);
		$menu_spacing->addPreset("padding", "menu_item_padding", __("Padding","oxygen-tutor-lms"), $menu_item_selector);
		$menu_spacing->addPreset("margin", "menu_item_margin", __("Margin","oxygen-tutor-lms"), $menu_item_selector);

		$this->typographySection(__("Title","oxygen-tutor-lms"), $selector.' .tutor-dashboard-content .tutor-dashboard-title', $this);
		$this->typographySection(__("Links","oxygen-tutor-lms"), $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner a', $this);
		$this->typographySection(__("Links Hover","oxygen-tutor-lms"), $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner a:hover', $this);

		/* Info card */
		$info_card_selector =  $selector.' .tutor-dashboard-content .tutor-dashboard-content-inner .tutor-card';
		$info_card = $this->addControlSection("info_card", __("Info Card"), "assets/icon.png", $this);
		$info_card->typographySection(__("Icon","oxygen-tutor-lms"), $info_card_selector.' .tutor-round-box i', $this);
		$info_card->typographySection(__("Value","oxygen-tutor-lms"), $info_card_selector.' .tutor-fw-bold', $this);
		$info_card->typographySection(__("Label","oxygen-tutor-lms"), $info_card_selector.' .tutor-color-secondary', $this);
		$info_card_background = $info_card->addControlSection("info_card_color", __("Background"), "assets/icon.png", $this);
		$info_card_background->addStyleControls(
			array(
				array(
					"name"		=> __('Color','oxygen-tutor-lms'),
					"selector" 	=> $info_card_selector,
					"property" 	=> 'background-color',
				),
			)
		);
		$info_icon = $info_card->addControlSection("dashboard_header_img", __("Icon Settings"), "assets/icon.png", $this);
		$info_icon->addStyleControls(
			array(
				array(
                	"name" => __('Height','oxygen-tutor-lms'),
                	"selector" => $info_card_selector.' .tutor-round-box',
					"property" => 'height',
				),
				array(
                	"name" => __('Width','oxygen-tutor-lms'),
                	"selector" => $info_card_selector.' .tutor-round-box',
					"property" => 'width',
				),
				array(
                	"name" => __('Background Color','oxygen-tutor-lms'),
                	"selector" => $info_card_selector.' .tutor-round-box',
					"property" => 'background-color',
				)
			)
		);
		$info_card_spacing = $info_card->addControlSection("info_card_spacing", __("Spacing"), "assets/icon.png", $this);
		$info_card_spacing->addPreset("padding", "info_card_padding", __("Padding","oxygen-tutor-lms"), $info_card_selector);
		$info_card_spacing->addPreset("margin", "info_card_margin", __("Margin","oxygen-tutor-lms"), $info_card_selector);
	}
}


new PageDashboard();