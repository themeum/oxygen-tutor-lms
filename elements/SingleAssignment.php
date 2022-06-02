<?php
namespace Oxygen\TutorElements;

class SingleAssignment extends \OxygenTutorElements {

	function name() {
		return 'Single Assignments';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		global $wp_query;
		/**
		 * Start Tutor Template
		 */
		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'tutor_assignments'){
			if (is_user_logged_in()){
				$template = otlms_get_template( 'single-assignment' );
			}else{
				$template = otlms_get_template('login');
			}
			include_once $template;
		}
		/**
		 * End Tutor Template
		 */
	}

	public function tutor_button_place() {
		return "single_template";
	}

	function controls() {
		$selector = '.tutor-course-single-content-wrapper';
		/* Sidebar */
		$sidebar = $this->addControlSection("sidebar", __("Sidebar"), "assets/icon.png", $this);
		$sidebar_selector = $selector." .tutor-course-single-sidebar-wrapper";
		$sidebar->borderSection(__("Border"), $sidebar_selector, $this);
		$sidebar->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $sidebar_selector,
                    "property" => 'background-color',
                )
            )
        );

		$sidebar_title_section = $sidebar->addControlSection("sidebar-title", __("Sidebar Title Area"), "assets/icon.png", $this);
		$sidebar_title_selector = $sidebar_selector." .tutor-course-single-sidebar-title";
		$sidebar_title_section->addStyleControls(
			array(
				array(
                	"name" => __('Background Color'),
                    "selector" => $sidebar_title_selector,
                    "property" => 'background-color',
                ),
				array(
                	"name" => __('Height'),
                	"selector" => $sidebar_title_selector,
					"property" => 'height',
				)
			)
		);
		$sidebar_title_section->addPreset("typography", "typography", __("Typography"), $sidebar_title_selector.' span', $this);
		$sidebar_title_section->addPreset("padding", "grid_padding", __("Padding"), $sidebar_title_selector);
		$sidebar_title_section->addPreset("margin", "grid_margin", __("Margin"), $sidebar_title_selector);


		$topic_spacing = $sidebar->addControlSection("topic-spacing", __("Topic Spacing"), "assets/icon.png", $this);
        $topic_spacing->addPreset("padding", "topic_item_padding", __("Padding"), '.tutor-course-topic');
        $topic_spacing->addPreset("margin", "topic_item_margin", __("Margin"), '.tutor-course-topic');
		$topic_title_selector = $selector.' .tutor-accordion-item-header .tutor-course-topic-title';
		$topic_summary_selector = $selector.' .tutor-accordion-item-header .tutor-course-topic-summary';
		$topic_icon_selector = $selector.' .tutor-accordion-item-header:after, .tutor-accordion-item-header.is-active:after';
		$sidebar->typographySection(__('Topic Ttile Typography'), $topic_title_selector, $this);
		$sidebar->typographySection(__('Topic Summary Typography'), $topic_summary_selector, $this);
		$topic_icon_section = $sidebar->addControlSection("topic-icon", __("Topic Icon"), "assets/icon.png", $this);
		$topic_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Color'),
                	"selector" => $topic_icon_selector,
					"property" => 'color',
                )
			)
		);
		$topic_background = $sidebar->addControlSection("topic-background", __("Topic Title Background"), "assets/icon.png", $this);
		$topic_background->addStyleControls(
			array(
				array(
                	"name" => __('Background Color'),
                    "selector" => '.tutor-accordion-item-header',
                    "property" => 'background-color',
                )
			)
		);
		
		$lesson_selector = $sidebar_selector.' .tutor-course-topic-item-title';
		$active_lesson_selector = $sidebar_selector.' .tutor-course-topic-item.is-active a';
		$sidebar->typographySection(__('Lesson Typography'), $lesson_selector, $this);
		$sidebar->typographySection(__('Active Lesson Typography'), $active_lesson_selector, $this);
		$lesson_icon_section = $sidebar->addControlSection("lesson-icon", __("Lesson Icon"), "assets/icon.png", $this);
		$lesson_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Icon Color'),
                	"selector" => $lesson_selector.' .tutor-course-topic-item-icon',
					"property" => 'color',
				),
				array(
                	"name" => __('Icon Active & Hover Color'),
                	"selector" => $active_lesson_selector.' .tutor-course-topic-item-icon',
					"property" => 'color',
				),
				array(
                	"name" => __('Lesson Background Color'),
                	"selector" => $lesson_selector,
					"property" => 'background-color',
				),
				array(
                	"name" => __('Active Lesson Background Color'),
                	"selector" => $active_lesson_selector,
					"property" => 'background-color',
				)
			)
		);
		$lesson_spacing = $sidebar->addControlSection("lesson-spacing", __("Lesson Spacing"), "assets/icon.png", $this);
        $lesson_spacing->addPreset("padding", "lesson_item_padding",  __("Padding"), $lesson_selector);

		/* Topbar */
		$topbar_selector = $selector.' #tutor-single-entry-content .tutor-course-topic-single-header';
		$topbar = $this->addControlSection("topbar", __("Topbar"), "assets/icon.png", $this);
		$topbar->typographySection(__('Title'), $topbar_selector.' .tutor-course-topic-single-header-title', $this);
		$topbar->typographySection(__('Progress'), $topbar_selector.' span', $this);
		$topbar_color = $topbar->addControlSection("content-top-bar", __("Size & Color"), "assets/icon.png", $this);
		$topbar_color->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => $topbar_selector,
					"property" => 'height',
                ),
				array(
                	"name" => __('Background'),
                	"selector" => $topbar_selector,
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Toggle Icon Background'),
                	"selector" => $topbar_selector.' .tutor-course-topics-sidebar-toggler',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Toggle Icon Color'),
                	"selector" => $topbar_selector.' .tutor-course-topics-sidebar-toggler span',
					"property" => 'color',
                ),
				array(
                	"name" => __('Close Icon Color'),
                	"selector" => $topbar_selector.' .tutor-iconic-btn span',
					"property" => 'color',
                )
			)
		);
		$topbar_spacing = $topbar->addControlSection("topbar-spacing", __("Spacing"), "assets/icon.png", $this);
        $topbar_spacing->addPreset("padding", "topbar_padding", __("Padding"),$topbar_selector);
        $topbar_spacing->addPreset("margin", "topbar_margin", __("Margin"),$topbar_selector);

		/* Content */
		$content = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
		$content_area_selector = $selector.' .tutor-quiz-single-entry-wrap .tutor-course-spotlight-wrapper';
		$content_full_area_selector = $selector.' .tutor-quiz-single-entry-wrap';
		$content_area_spacing = $content->addControlSection("content-area-spacing", __("Spacing"), "assets/icon.png", $this);
        $content_area_spacing->addPreset(
            "padding",
            "content_area_padding",
            __("Padding"),
            $content_area_selector
		);
        $content_area_spacing->addPreset(
            "margin",
            "content_area_pmargin",
            __("Margin"),
            $content_area_selector
		);
		
		$content_background = $content->addControlSection("content-background", __("Background"), "assets/icon.png", $this);
		$content_background->addStyleControls(
			array(
				array(
                	"name" => __('Background'),
                	"selector" => $content_full_area_selector,
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $content_area_selector.' .tutor-color-black ,' .$content_area_selector.' .tutor-color-secondary',
					"property" => 'color',
                )
			)
		);

		/* Pagination */
		$pagination = $this->addControlSection("pagination", __("Pagination"), "assets/icon.png", $this);
		$pagination_selector = $selector.' .tutor-course-topic-single-footer';
		$pagination->typographySection(__('Typography'), $pagination_selector.' a', $this);
		$pagination_color = $pagination->addControlSection("pagination-color", __("Color"), "assets/icon.png", $this);
		$pagination_color->addStyleControls(
			array(
				array(
                	"name" => __('Height'),
                	"selector" => $pagination_selector,
					"property" => 'height',
                ),
				array(
                	"name" => __('Pagination Background'),
                	"selector" => $pagination_selector,
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Previous Background'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-prev a',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Previous Color'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-prev a span',
					"property" => 'color',
                ),
				array(
                	"name" => __('Previous Hover Background'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-prev a:hover',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Previous Hover Color'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-prev a:hover span',
					"property" => 'color',
                ),
				array(
                	"name" => __('Next Background'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-next a',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Next Color'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-next a span',
					"property" => 'color',
                ),
				array(
                	"name" => __('Next Hover Background'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-next a:hover',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Next Hover Color'),
                	"selector" => $pagination_selector.' .tutor-single-course-content-next a:hover span',
					"property" => 'color',
                )
			)
		);
	}
}


new SingleAssignment();