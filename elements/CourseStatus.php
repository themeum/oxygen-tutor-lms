<?php
namespace Oxygen\TutorElements;

class CourseStatus extends \OxygenTutorElements {

	function name() {
        return 'Status';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

    function render($options, $defaults, $content) {
        $action = tutils()->array_get('action', $_GET);
        if ($action == 'oxy_render_oxy-course-status') {
           _e('Preview not available', 'oxygen-tutor-lms');
        } else if (is_user_logged_in() && tutils()->is_enrolled()) {
            include_once otlms_get_template('course/status');
        }
    }

    function controls() {
        $selector = '.tutor-course-status';
        $this->typographySection('Label', $selector.' .tutor-segment-title');

        $this->addStyleControls(
			array(
				array(
                	"name" => __('Color'),
                	"selector" => $selector.' .tutor-progress-bar',
					"property" => 'background-color',
				),
				array(
                	"name" => __('Fill Color'),
                	"selector" => $selector.' .tutor-progress-filled',
					"property" => 'background-color',
                ),
				array(
                	"name" => __('Pointer Color'),
                	"selector" => $selector.' .tutor-progress-filled:after',
					"property" => 'border-color',
				)
			)
        );
    }
}

new CourseStatus();