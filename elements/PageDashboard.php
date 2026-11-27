<?php
/**
 * Dashboard Page Element.
 *
 * @package OxygenTutorLMS\Elements
 * @author  Themeum <support@themeum.com>
 * @link    https://themeum.com
 * @since   1.0.0
 */

namespace Oxygen\TutorElements;

/**
 * Class PageDashboard.
 *
 * @since 1.0.0
 */
class PageDashboard extends \OxygenTutorElements {

	/**
	 * Get element name.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function name() {
		return 'Dashboard';
	}

	/**
	 * Get element icon URL.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function icon() {
		return plugin_dir_url( OTLMS_FILE ) . 'assets/icons/' . basename( __FILE__, '.php' ) . '.svg';
	}

	/**
	 * Render element output.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $options  Element options.
	 * @param array  $defaults Default options.
	 * @param string $content  Element inner content.
	 *
	 * @return void
	 */
	public function render( $options, $defaults, $content ) {
		/**
		 * Start Tutor Template
		 */

		global $wp_query;
		$dashboard_page = tutor_utils()->array_get( 'tutor_dashboard_page', $wp_query->query_vars );

		if ( 'create-course' === $dashboard_page ) {
			return;
		}

		$get_dashboard_config  = tutils()->tutor_dashboard_permalinks();
		$target_dashboard_page = tutils()->array_get( $dashboard_page, $get_dashboard_config );
		$template              = otlms_get_template( 'retrieve-password' );
		if ( isset( $target_dashboard_page['login_require'] ) && false === $target_dashboard_page['login_require'] ) {
			$template = otlms_get_template( 'retrieve-password' );
		} elseif ( is_user_logged_in() ) {
				$template = otlms_get_template( 'dashboard' );
		} else {
			$template = otlms_get_template( 'login' );
		}

		ob_start();
		$is_shortcode = true;
		/**
		 * Tutor template load function removed cause it had been called multiple times
		 * & thus template was loading multiple times
		 * to fix added include_once
		 *
		 * @since version 1.0.3
		 */
		include_once $template;

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped, WordPress.NamingConventions.ValidHookName.UseUnderscores -- Template output is escaped internally; tutor_dashboard/index is a Tutor core filter.
		echo apply_filters( 'tutor_dashboard/index', ob_get_clean() );

		// Avoid re-evaluating scripts in the builder iframe during AJAX renders.
		if ( defined( 'OXY_ELEMENTS_API_AJAX' ) && OXY_ELEMENTS_API_AJAX ) {
			$wp_scripts = wp_scripts();
			if ( is_object( $wp_scripts ) && isset( $wp_scripts->queue ) ) {
				$wp_scripts->queue = array();
			}
		}

		/**
		 * End Tutor Template
		 */
	}

	/**
	 * Get Oxygen toolbar button section.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function tutor_button_place() {
		return 'pages';
	}

	/**
	 * Register element styling controls.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function controls() {
		$selector         = '.tutor-dashboard-layout';
		$header_selector  = $selector . ' .tutor-dashboard-header';
		$sidebar_selector = $selector . ' .tutor-dashboard-sidebar';
		$menu_selector    = $sidebar_selector . ' .tutor-dashboard-sidebar-nav';
		$page_selector    = $selector . ' .tutor-dashboard-page';

		$this->register_header_controls( $header_selector );
		$this->register_header_button_controls( $header_selector );
		$this->register_menu_controls( $sidebar_selector, $menu_selector );

		$title_selector = $page_selector . ' h4, ' . $page_selector . ' .tutor-h4, ' . $page_selector . ' .tutor-dashboard-home-chart-header > .tutor-small, ' . $page_selector . ' .tutor-dashboard-home-card > .tutor-small';
		$this->typographySection( __( 'Title', 'oxygen-tutor-lms' ), $title_selector, $this );
		$this->typographySection( __( 'Links', 'oxygen-tutor-lms' ), $page_selector . ' a', $this );
		$this->typographySection( __( 'Links Hover', 'oxygen-tutor-lms' ), $page_selector . ' a:hover', $this );

		$this->register_info_card_controls( $page_selector );
		$this->register_content_card_controls( $selector, $page_selector );
	}

	/**
	 * Register dashboard header style controls.
	 *
	 * @since 4.0.1
	 *
	 * @param string $header_selector CSS selector for the dashboard header.
	 *
	 * @return void
	 */
	private function register_header_controls( $header_selector ) {
		$header = $this->addControlSection( 'dashboard_header', __( 'Header', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$header->addStyleControls(
			array(
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $header_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Border Color', 'oxygen-tutor-lms' ),
					'selector' => $header_selector,
					'property' => 'border-bottom-color',
				),
			)
		);

		$avatar_selector = $header_selector . ' .tutor-dashboard-header-user-avatar .tutor-avatar';
		$header_avatar   = $header->addControlSection( 'dashboard_header_img', __( 'Avatar', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$header_avatar->addStyleControls(
			array(
				array(
					'name'     => __( 'Height', 'oxygen-tutor-lms' ),
					'selector' => $avatar_selector,
					'property' => 'height',
				),
				array(
					'name'     => __( 'Width', 'oxygen-tutor-lms' ),
					'selector' => $avatar_selector,
					'property' => 'width',
				),
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $avatar_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Initials Color', 'oxygen-tutor-lms' ),
					'selector' => $avatar_selector,
					'property' => 'color',
				),
				array(
					'name'     => __( 'Border Color', 'oxygen-tutor-lms' ),
					'selector' => $header_selector . ' .tutor-dashboard-header-user-avatar',
					'property' => 'border-color',
				),
			)
		);

		$header->typographySection( __( 'Display Name', 'oxygen-tutor-lms' ), $header_selector . ' .tutor-dashboard-header-left .tutor-h5', $this );
		$header->typographySection( __( 'Stats Text', 'oxygen-tutor-lms' ), $header_selector . ' .tutor-dashboard-header-left .tutor-tiny', $this );
	}

	/**
	 * Register dashboard header button style controls.
	 *
	 * @since 4.0.1
	 *
	 * @param string $header_selector CSS selector for the dashboard header.
	 *
	 * @return void
	 */
	private function register_header_button_controls( $header_selector ) {
		$header_btn          = $this->addControlSection( 'new_course_btn', __( 'Header Button', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$header_btn_selector = $header_selector . ' .tutor-dashboard-header-right > div:first-child .tutor-btn';

		$header_btn->addPreset( 'padding', 'submit_padding', __( 'Button Paddings', 'oxygen-tutor-lms' ), $header_btn_selector );
		$header_btn->addStyleControls(
			array(
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $header_btn_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Hover Background Color', 'oxygen-tutor-lms' ),
					'selector' => $header_btn_selector . ':hover',
					'property' => 'background-color',
				),
				array(
					'name'         => __( 'Color', 'oxygen-tutor-lms' ),
					'control_type' => 'colorpicker',
					'slug'         => 'header_btn_color',
					'selectors'    => array(
						array(
							'selector' => $header_btn_selector,
							'property' => 'color',
						),
						array(
							'selector' => $header_btn_selector . ' svg',
							'property' => 'color',
						),
					),
				),
				array(
					'name'         => __( 'Hover Color', 'oxygen-tutor-lms' ),
					'control_type' => 'colorpicker',
					'slug'         => 'header_btn_hover_color',
					'selectors'    => array(
						array(
							'selector' => $header_btn_selector . ':hover',
							'property' => 'color',
						),
						array(
							'selector' => $header_btn_selector . ':hover svg',
							'property' => 'color',
						),
					),
				),
			)
		);
		$header_btn->typographySection( __( 'Typography', 'oxygen-tutor-lms' ), $header_btn_selector, $this );
		$header_btn->borderSection( __( 'Borders', 'oxygen-tutor-lms' ), $header_btn_selector, $this );
		$header_btn->borderSection( __( 'Hover Borders', 'oxygen-tutor-lms' ), $header_btn_selector . ':hover', $this );
		$header_btn->boxShadowSection( __( 'Shadow', 'oxygen-tutor-lms' ), $header_btn_selector, $this );
		$header_btn->boxShadowSection( __( 'Hover Shadow', 'oxygen-tutor-lms' ), $header_btn_selector . ':hover', $this );
	}

	/**
	 * Register dashboard sidebar and navigation menu style controls.
	 *
	 * @since 4.0.1
	 *
	 * @param string $sidebar_selector CSS selector for the dashboard sidebar container.
	 * @param string $menu_selector    CSS selector for the sidebar navigation wrapper.
	 *
	 * @return void
	 */
	private function register_menu_controls( $sidebar_selector, $menu_selector ) {
		$menu               = $this->addControlSection( 'menu', __( 'Menu', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$menu_item_selector = $menu_selector . ' ul li a';

		$menu->addStyleControls(
			array(
				array(
					'name'     => __( 'Sidebar Background Color', 'oxygen-tutor-lms' ),
					'selector' => $sidebar_selector,
					'property' => 'background-color',
				),
				array(
					'name'         => __( 'Sidebar Border Color', 'oxygen-tutor-lms' ),
					'control_type' => 'colorpicker',
					'selector'     => $sidebar_selector,
					'property'     => 'border-inline-end-color',
				),
			)
		);

		$menu_logo          = $menu->addControlSection( 'menu_logo', __( 'Logo', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$menu_logo_selector = $sidebar_selector . ' .tutor-dashboard-sidebar-logo';
		$menu_logo->addStyleControls(
			array(
				array(
					'name'     => __( 'Text Color', 'oxygen-tutor-lms' ),
					'selector' => $menu_logo_selector . ' .site-title',
					'property' => 'color',
				),
				array(
					'name'     => __( 'Font Size', 'oxygen-tutor-lms' ),
					'selector' => $menu_logo_selector . ' .site-title',
					'property' => 'font-size',
				),
				array(
					'name'     => __( 'Image Max Width', 'oxygen-tutor-lms' ),
					'selector' => $menu_logo_selector . ' img',
					'property' => 'max-width',
				),
				array(
					'name'     => __( 'Border Color', 'oxygen-tutor-lms' ),
					'selector' => $menu_logo_selector,
					'property' => 'border-bottom-color',
				),
			)
		);

		$menu_states = array(
			'menu_item'        => array(
				'label'    => __( 'Item', 'oxygen-tutor-lms' ),
				'selector' => $menu_item_selector,
			),
			'menu_item_hover'  => array(
				'label'    => __( 'Item Hover', 'oxygen-tutor-lms' ),
				'selector' => $menu_item_selector . ':hover',
			),
			'menu_item_active' => array(
				'label'    => __( 'Item Active', 'oxygen-tutor-lms' ),
				'selector' => $menu_item_selector . '.active',
			),
		);

		foreach ( $menu_states as $state_slug => $state_config ) {
			$this->add_menu_item_state_controls( $menu, $state_slug, $state_config['label'], $state_config['selector'] );
		}

		$menu_spacing = $menu->addControlSection( 'menu_item_spacing', __( 'Spacing', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$menu_spacing->addPreset( 'padding', 'menu_item_padding', __( 'Padding', 'oxygen-tutor-lms' ), $menu_item_selector );
		$menu_spacing->addPreset( 'margin', 'menu_item_margin', __( 'Margin', 'oxygen-tutor-lms' ), $menu_item_selector );
	}

	/**
	 * Register typography, icon, and background controls for a single menu item state.
	 *
	 * @since 4.0.1
	 *
	 * @param object $menu_section Parent menu control section.
	 * @param string $state_slug   Control section slug.
	 * @param string $label        Control section label.
	 * @param string $item_selector CSS selector for the menu item state.
	 *
	 * @return void
	 */
	private function add_menu_item_state_controls( $menu_section, $state_slug, $label, $item_selector ) {
		$state_section = $menu_section->addControlSection( $state_slug, $label, 'assets/icon.png', $this );
		$state_section->addStyleControls(
			array(
				array(
					'name'     => __( 'Icon Color', 'oxygen-tutor-lms' ),
					'selector' => $item_selector . ' svg',
					'property' => 'color',
				),
				array(
					'name'         => __( 'Icon Size', 'oxygen-tutor-lms' ),
					'control_type' => 'measurebox',
					'slug'         => $state_slug . '_icon_size',
					'unit'         => 'px',
					'selectors'    => array(
						array(
							'selector' => $item_selector . ' svg',
							'property' => 'width',
						),
						array(
							'selector' => $item_selector . ' svg',
							'property' => 'height',
						),
					),
				),
				array(
					'name'     => __( 'Font Color', 'oxygen-tutor-lms' ),
					'selector' => $item_selector,
					'property' => 'color',
				),
				array(
					'name'     => __( 'Font Size', 'oxygen-tutor-lms' ),
					'selector' => $item_selector,
					'property' => 'font-size',
				),
				array(
					'name'     => __( 'Font Family', 'oxygen-tutor-lms' ),
					'selector' => $item_selector,
					'property' => 'font-family',
				),
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $item_selector,
					'property' => 'background-color',
				),
			)
		);
	}

	/**
	 * Register dashboard stat / info card controls.
	 *
	 * @since 4.0.1
	 *
	 * @param string $page_selector CSS selector for the dashboard page content wrapper.
	 *
	 * @return void
	 */
	private function register_info_card_controls( $page_selector ) {
		$info_card_selector = $page_selector . ' .tutor-stat-card';
		$info_card          = $this->addControlSection( 'info_card', __( 'Info Card', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );

		$info_card->typographySection( __( 'Icon', 'oxygen-tutor-lms' ), $info_card_selector . ' .tutor-stat-card-icon', $this );
		$info_card->typographySection( __( 'Value', 'oxygen-tutor-lms' ), $info_card_selector . ' .tutor-stat-card-value', $this );
		$info_card->typographySection( __( 'Label', 'oxygen-tutor-lms' ), $info_card_selector . ' .tutor-stat-card-title', $this );

		$info_card_background = $info_card->addControlSection( 'info_card_color', __( 'Background', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$info_card_background->addStyleControls(
			array(
				array(
					'name'     => __( 'Color', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Hover Color', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector . ':hover',
					'property' => 'background-color',
				),
			)
		);

		$info_icon = $info_card->addControlSection( 'info_card_icon_settings', __( 'Icon Settings', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$info_icon->addStyleControls(
			array(
				array(
					'name'     => __( 'Height', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector . ' .tutor-stat-card-icon svg',
					'property' => 'height',
				),
				array(
					'name'     => __( 'Width', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector . ' .tutor-stat-card-icon svg',
					'property' => 'width',
				),
				array(
					'name'     => __( 'Icon Color', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector . ' .tutor-stat-card-icon',
					'property' => 'color',
				),
				array(
					'name'     => __( 'Background Color', 'oxygen-tutor-lms' ),
					'selector' => $info_card_selector . ' .tutor-stat-card-icon',
					'property' => 'background-color',
				),
			)
		);

		$info_card->borderSection( __( 'Borders', 'oxygen-tutor-lms' ), $info_card_selector, $this );

		$info_card_spacing = $info_card->addControlSection( 'info_card_spacing', __( 'Spacing', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$info_card_spacing->addPreset( 'padding', 'info_card_padding', __( 'Padding', 'oxygen-tutor-lms' ), $info_card_selector );
		$info_card_spacing->addPreset( 'margin', 'info_card_margin', __( 'Margin', 'oxygen-tutor-lms' ), $info_card_selector );
	}

	/**
	 * Register controls for the dashboard main content area and home/section cards.
	 *
	 * @since 4.0.1
	 *
	 * @param string $selector      Root dashboard layout CSS selector.
	 * @param string $page_selector Dashboard page content CSS selector.
	 *
	 * @return void
	 */
	private function register_content_card_controls( $selector, $page_selector ) {
		$content_cards         = $this->addControlSection( 'dashboard_content_cards', __( 'Content & Cards', 'oxygen-tutor-lms' ), 'assets/icon.png', $this );
		$section_card_selector = $page_selector . ' .tutor-dashboard-home-chart, ' . $page_selector . ' .tutor-dashboard-home-card, ' . $page_selector . ' .tutor-dashboard-page-card';
		$item_card_selector    = $page_selector . ' .tutor-dashboard-home-review, ' . $page_selector . ' .tutor-dashboard-home-course, ' . $page_selector . ' .tutor-dashboard-home-task';

		$content_cards->addStyleControls(
			array(
				array(
					'name'     => __( 'Content Background Color', 'oxygen-tutor-lms' ),
					'selector' => $selector . ', ' . $selector . ' .tutor-dashboard-main',
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Card Background Color', 'oxygen-tutor-lms' ),
					'selector' => $section_card_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Card Border Color', 'oxygen-tutor-lms' ),
					'selector' => $section_card_selector,
					'property' => 'border-color',
				),
				array(
					'name'     => __( 'Item Card Background', 'oxygen-tutor-lms' ),
					'selector' => $item_card_selector,
					'property' => 'background-color',
				),
				array(
					'name'     => __( 'Item Card Border Color', 'oxygen-tutor-lms' ),
					'selector' => $item_card_selector,
					'property' => 'border-color',
				),
			)
		);
	}
}


new PageDashboard();
