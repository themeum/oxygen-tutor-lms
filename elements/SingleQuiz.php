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
		$sidebar->typographySection('Tabs Typography', $tabs_selector.' a span', $this);
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
		$sidebar->typographySection('Topic Typography', $topic_selector, $this);
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
		$sidebar->typographySection('Lesson Typography', $lesson_selector.' span', $this);
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

		/* Content bar */
		$content = $this->addControlSection("content", __("Content"), "assets/icon.png", $this);
		$top_bar_selector = $selector.' .tutor-single-page-top-bar';
		$content->typographySection('Topbar Home link', $top_bar_selector.' a', $this);
		$content->typographySection('Topbar Title', $top_bar_selector.' .tutor-topbar-content-title-wrap', $this);
		$content_top_bar = $content->addControlSection("content-top-bar", __("Topbar Color"), "assets/icon.png", $this);
		$content_top_bar->addStyleControls(
			array(
				array(
                	"name" => __('Background'),
                	"selector" => $top_bar_selector,
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Toggle Bar'),
                	"selector" => $top_bar_selector.' .tutor-lesson-sidebar-hide-bar',
					"property" => 'background-color',
                )
			)
		);
		$content_top_bar_spacing = $content->addControlSection("topbar-spacing", __("Topbar Spacing"), "assets/icon.png", $this);
        $content_top_bar_spacing->addPreset(
            "padding",
            "topbar_padding",
            __("Padding"),
            $top_bar_selector
		);
        $content_top_bar_spacing->addPreset(
            "margin",
            "topbar_margin",
            __("Margin"),
            $top_bar_selector
		);

		$content_area_selector = $selector.' .tutor-quiz-single-wrap';
		$content->typographySection('Quiz Title', $content_area_selector.' .tutor-quiz-header h2', $this);
		$content->typographySection('Quiz Course Label', $content_area_selector.' .tutor-quiz-header h5', $this);
		$content->typographySection('Quiz Course Title', $content_area_selector.' .tutor-quiz-header h5 a', $this);
		$content->typographySection('Quiz Meta Label', $content_area_selector.' .tutor-quiz-meta li strong', $this);
		$content->typographySection('Quiz Meta Value', $content_area_selector.' .tutor-quiz-meta li', $this);

		$start_quiz_button = $content->addControlSection("start-quiz-button", __("Quiz Start Button"), "assets/icon.png", $this);
        $start_quiz_button_selector = '.tutor-quiz-body .tutor-button';
        $start_quiz_button->addStyleControls(
            array(
				array(
                    "name" => 'Font Size',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => 'Font Color',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'color',
                ),
                array(
                    "name" => 'Font Family',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'font-family',
                ),
                array(
                    "name" => 'Background Color',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'background-color',
                ),
				array(
                    "name" => 'Border Color',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'border-color',
                ),
                array(
                    "name" => 'Border Radius',
                    "selector" => $start_quiz_button_selector,
                    "property" => 'border-radius',
                ),
                array(
                    "name" => 'Hover Background Color',
                    "selector" => $start_quiz_button_selector.':hover',
                    "property" => 'background-color',
				),
                array(
                    "name" => 'Hover Border Color',
                    "selector" => $start_quiz_button_selector.':hover',
                    "property" => 'border-color',
                ),
            )
		);
		$start_quiz_button->addPreset(
            "padding",
            "button_padding",
            __("Button Padding"),
            $start_quiz_button_selector
        );

		$content_area_spacing = $content->addControlSection("content-area-spacing", __("Area Spacing"), "assets/icon.png", $this);
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
		$pagination->typographySection('Typography', $pagination_selector.' a', $this);
		$pagination->typographySection('Typography Hover', $pagination_selector.' a:hover', $this);
	}

}


new SingleQuiz();