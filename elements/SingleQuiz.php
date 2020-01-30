<?php
namespace Oxygen\TutorElements;

class SingleQuiz extends \OxygenTutorElements {

	function name() {
		return 'Single Quiz';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		global $wp_query;
		/**
		 * Start Tutor Template
		 */
		if ($wp_query->is_single && ! empty($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'tutor_quiz'){
			if (is_user_logged_in()){
				$template = otlms_get_template( 'single-quiz' );
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
		$selector = '.tutor-single-lesson-wrap';
		/* Sidebar */
		$sidebar = $this->addControlSection("sidebar", __("Sidebar"), "assets/icon.png", $this);
		$tabs_selector = $selector." .tutor-tabs-btn-group";
		$sidebar->typographySection(__('Tabs Typography'), $tabs_selector.' a span', $this);
		$tab_icon_section = $sidebar->addControlSection("tabs-icon", __("Tabs Icon"), "assets/icon.png", $this);
		$tab_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $tabs_selector.' a i',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $tabs_selector.' a i',
					"property" => 'color',
				)
			)
		);
		$topic_selector = $selector.' .tutor-topics-title h3';
		$sidebar->typographySection(__('Topic Typography'), $topic_selector, $this);
		$topic_icon_section = $sidebar->addControlSection("topic-icon", __("Topic Icon"), "assets/icon.png", $this);
		$topic_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Color'),
                	"selector" => $topic_selector.' span',
					"property" => 'color',
                ),
				array(
                	"name" => __('Background'),
                	"selector" => $topic_selector.' span',
					"property" => 'background-color',
				)
			)
		);
		$topic_toggle_icon_selector = $selector.' .tutor-single-lesson-topic-toggle i';
		$topic_toggle_icon_section = $sidebar->addControlSection("topic-toggle-icon", __("Topic Toggle Icon"), "assets/icon.png", $this);
		$topic_toggle_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $topic_toggle_icon_selector,
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $topic_toggle_icon_selector,
					"property" => 'color',
				)
			)
		);
		$topic_spacing = $sidebar->addControlSection("topic-spacing", __("Topic Spacing"), "assets/icon.png", $this);
        $topic_spacing->addPreset(
            "padding",
            "topic_item_padding",
            __("Padding"),
            $topic_selector
		);
		
		$lesson_selector = $selector.' .tutor-lessons-under-topic .tutor-single-lesson-items a';
		$sidebar->typographySection(__('Lesson Typography'), $lesson_selector.' span', $this);
		$lesson_icon_section = $sidebar->addControlSection("lesson-icon", __("Lesson Icon"), "assets/icon.png", $this);
		$lesson_icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Size'),
                	"selector" => $lesson_selector.' i:first-child',
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color'),
                	"selector" => $lesson_selector.' i:first-child',
					"property" => 'color',
				)
			)
		);
		$lesson_spacing = $sidebar->addControlSection("lesson-spacing", __("Lesson Spacing"), "assets/icon.png", $this);
        $lesson_spacing->addPreset(
            "padding",
            "lesson_item_padding",
            __("Padding"),
            $lesson_selector
		);
		$sidebar_background = $sidebar->addControlSection("sidebar-background", __("Background"), "assets/icon.png", $this);
		$sidebar_background->addStyleControls(
			array(
				array(
					"name" => __('Tab Background'),
					"selector" => $selector.' .tutor-tabs-btn-group a',
					"property" => 'background-color',
				),
				array(
					"name" => __('Tab Active Background'),
					"selector" => $selector.' .tutor-tabs-btn-group a.active',
					"property" => 'background-color',
				),
				array(
					"name" => __('Lesson Background'),
					"selector" => $selector.' .tutor-topics-in-single-lesson',
					"property" => 'background-color',
				),
				array(
					"name" => __('Q&A Background'),
					"selector" => $selector.' .tutor-lesson-sidebar-tab-item',
					"property" => 'background-color',
				)
			)
		);

		/* Topbar */
		$topbar_selector = $selector.' .tutor-single-page-top-bar';
		$topbar = $this->addControlSection("topbar", __("Topbar"), "assets/icon.png", $this);
		$topbar->typographySection(__('Home link'), $topbar_selector.' a', $this);
		$topbar->typographySection(__('Title'), $topbar_selector.' .tutor-topbar-content-title-wrap', $this);
		$topbar_color = $topbar->addControlSection("content-top-bar", __("Color"), "assets/icon.png", $this);
		$topbar_color->addStyleControls(
			array(
				array(
                	"name" => __('Background'),
                	"selector" => $topbar_selector,
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Toggle Bar'),
                	"selector" => $topbar_selector.' .tutor-lesson-sidebar-hide-bar',
					"property" => 'background-color',
                )
			)
		);
		$topbar_spacing = $topbar->addControlSection("topbar-spacing", __("Spacing"), "assets/icon.png", $this);
        $topbar_spacing->addPreset(
            "padding",
            "topbar_padding",
            __("Padding"),
            $topbar_selector
		);
        $topbar_spacing->addPreset(
            "margin",
            "topbar_margin",
            __("Margin"),
            $topbar_selector
		);

		/* Content */
		$content = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
		$content_area_selector = $selector.' .tutor-quiz-single-wrap';
		$content->typographySection(__('Quiz Title'), $content_area_selector.' .tutor-quiz-header h2', $this);
		$content->typographySection(__('Course Label'), $content_area_selector.' .tutor-quiz-header h5', $this);
		$content->typographySection(__('Course Title'), $content_area_selector.' .tutor-quiz-header h5 a', $this);
		$content->typographySection(__('Meta Label'), $content_area_selector.' .tutor-quiz-meta li strong', $this);
		$content->typographySection(__('Meta Value'), $content_area_selector.' .tutor-quiz-meta li', $this);

		/* Start Button */
		$start_quiz_button = $this->addControlSection("start-quiz-button", __("Start Button"), "assets/icon.png", $this);
        $start_quiz_button_selector = '.tutor-quiz-body .tutor-button';
        $start_quiz_button->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings"),
            $start_quiz_button_selector
        );
        $start_quiz_button->addStyleControls(
            array(
                array(
                    "name" => __('Background Color'),
                    "selector" => $start_quiz_button_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" =>__('Hover Background Color'),
                    "selector" => $start_quiz_button_selector.":hover",
                    "property" => 'background-color',
                )
            )
        );
        $start_quiz_button->typographySection(__("Typography"), $start_quiz_button_selector, $this);
        $start_quiz_button->borderSection(__("Borders"), $start_quiz_button_selector, $this);
        $start_quiz_button->borderSection(__("Hover Borders"), $start_quiz_button_selector.":hover", $this);
        $start_quiz_button->boxShadowSection(__("Shadow"), $start_quiz_button_selector, $this);
        $start_quiz_button->boxShadowSection(__("Hover Shadow"), $start_quiz_button_selector.":hover", $this);

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
                	"selector" => $selector,
					"property" => 'background-color',
                )
			)
		);

		/* Pagination */
		$pagination = $this->addControlSection("pagination", __("Pagination"), "assets/icon.png", $this);
		$pagination_selector = $selector.' .tutor-next-previous-pagination-wrap';
		$pagination->typographySection(__('Typography'), $pagination_selector.' a', $this);
		$pagination->typographySection(__('Hover Typography'), $pagination_selector.' a:hover', $this);
	}

}


new SingleQuiz();