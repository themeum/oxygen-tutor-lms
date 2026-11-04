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
        echo '<div class="tutor-course-topics">';
        tutor_course_topics();
        echo '</div>';
    }

    function class_names() {
        return array('tutor-course-curriculum', 'oxy-tutor-element');
    }

    function controls() {
        $selector = '.tutor-course-topics';

        $course_curriculum = $this->addControlSection("curriculum", __("Curriculum"), "assets/icon.png", $this);
		$curriculum_selector = $selector." .tutor-mt-40";
        $course_curriculum->typographySection(__('Header Title'), $curriculum_selector.' h3', $this);

        $course_topic = $curriculum_selector." .tutor-accordion .tutor-accordion-item";
        $course_curriculum->typographySection(__('Topic Title'), $course_topic.' .tutor-accordion-item-header, .tutor-accordion-item-header::after', $this);
        $course_curriculum->typographySection(__('Active Topic Title'), $course_topic.' .tutor-accordion-item-header.is-active, .tutor-accordion-item-header.is-active::after', $this);

        $course_curriculum->typographySection(__('Lesson, Quiz & Assignment Title'), $course_topic. ' .tutor-course-content-list-item-title, .tutor-course-content-list-item-title a', $this);
        $icon_selector = $course_topic. ' .tutor-course-content-list-item .tutor-course-content-list-item-icon, .tutor-course-content-list-item .tutor-course-content-list-item-status';
        $icon_section = $course_curriculum->addControlSection("lesson-icon", __("Lesson, Quiz & Assignment Icon"), "assets/icon.png", $this);
		$icon_section->addStyleControls(
			array(
				array(
                	"name" => __('Size','oxygen-tutor-lms'),
                	"selector" => $icon_selector,
					"property" => 'font-size',
                ),
				array(
                	"name" => __('Color','oxygen-tutor-lms'),
                	"selector" => $icon_selector,
					"property" => 'color',
				)
			)
        );
    }

}

new CourseCurriculum();