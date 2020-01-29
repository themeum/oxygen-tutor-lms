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

		$shortcode = new Shortcode();
		echo $shortcode->tutor_dashboard();

		/**
		 * End Tutor Template
		 */
	}

	function tutor_button_place() {
		return "pages";
	}

	function controls() {
		$selector = '.tutor-dashboard';
		$menu = $this->addControlSection("menu", __("Menu"), "assets/icon.png", $this);
		$menu_selector = $selector.' .tutor-dashboard-permalinks';
		$menu_item_selector = $menu_selector.' li a';
		$menu_item_selector_hover = $menu_selector.' li a:hover';
		$menu_item_selector_active = $menu_selector.' li.active a';
		/* Menu item */
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