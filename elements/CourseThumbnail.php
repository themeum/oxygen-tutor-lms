<?php
namespace Oxygen\TutorElements;

class CourseThumbnail extends \OxygenTutorElements {

	function name() {
        return 'Thumbnail';
    }

    function tutor_button_place() {
        return "single_course";
    }

    function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
    }
    
    function render($options, $defaults, $content) {
        if(tutils()->has_video_in_single()){
			tutor_course_video();
		} else{
			get_tutor_course_thumbnail();
		}
    }


    function class_names() {
        return array('tutor-course-thumbnail', 'oxy-tutor-element');
    }


    function controls() {

    }

}

new CourseThumbnail();