<?php
namespace Oxygen\TutorElements;

class CourseCurriculum extends \OxygenTutorElements {

	function name() {
        return 'Curriculum';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        tutor_course_topics();
    }

    function class_names() {
        return array('tutor-course-curriculum', 'oxy-tutor-element');
    }

    function controls() {
        //Topic header
        $topic_header = ".tutor-course-topics-header";
        $this->typographySection('Header Title', $topic_header.' .tutor-segment-title');
        $this->typographySection('Header Info', $topic_header. ' .tutor-course-topics-header-right');

        //Course Topics
        $course_topic = ".tutor-course-topic";
        $this->typographySection('Topic Title', $course_topic.' .tutor-course-title h4');
        $icon_selector = $course_topic. ' .tutor-course-lesson h5 i';
        $icon_section = $this->addControlSection("lesson-icon", __("Lesson Icon"), "assets/icon.png", $this);
		$icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Font Size'),
                	"selector" => $icon_selector,
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Font Color'),
                	"selector" => $icon_selector,
					"property" => 'color',
				)
			)
        );
        $this->typographySection('Lesson Title', $course_topic. ' .tutor-course-lesson h5, .tutor-course-lesson h5 a');
        //spacing
        $space_section = $this->addControlSection("topic-spacing", __("Spacing"), "assets/icon.png", $this);
        $space_section->addPreset(
            "padding",
            "topic_title_padding",
            __("Topic Title Padding"),
            '.tutor-course-title'
        );
        $space_section->addPreset(
            "padding",
            "lesson_title_padding",
            __("Lesson Title Padding"),
            '.tutor-course-lesson'
        );
    }

}

new CourseCurriculum();