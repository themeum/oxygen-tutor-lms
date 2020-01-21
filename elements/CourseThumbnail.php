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
        echo "<div class='tutor-course-thumbnail'>";
            if(tutils()->has_video_in_single()){
                tutor_course_video();
            } else{
                get_tutor_course_thumbnail();
            }
        echo "</div>";
    }

    function controls() {
        $selector = ".tutor-course-thumbnail";
        /*
         * Original Thumbnail
         */
		$original_thumb = $this->addControlSection("tutor_origianl_thumb", __("Original Thumbnails"), "assets/icon.png", $this);
		$original_thumb->addStyleControls(
            array(
                array(
                    "selector" => $selector." img",
                    "property" => 'opacity',
				),
				array(
                    "selector" => $selector,
                    "property" => 'background-color',
                ),
            )
        );
		$original_thumb->addStyleControl(
        	array(
				"name" => __("Border Color"),
				"selector" => $selector,
        		"property" => 'border-color',
        	)
		);
		$original_thumb_borderWidth = $original_thumb->addStyleControl(
        	array(
				"name" => __("Border Width"),
				"selector" => $selector,
        		"property" => 'border-width',
        	)
		);

		$original_thumb_borderWidth->setUnits("px","px,em");
		$original_thumb->addPreset(
            "margin",
            "tutor_original_thumb_margins",
            __("Margin"),
            $selector
		);

		$original_thumb_box_shadow = $original_thumb->addControlSection("tutor_original_thumb_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		$original_thumb_box_shadow->addPreset(
            "box-shadow",
            "tutor_original_thumb_shadow",
            __("Original Thumbs Shadow"),
            $selector
        );

        /**
         * Hovered Thumbnail
         */
		$hover_thumb = $this->addControlSection("tutor_hover_thumb", __("Hovered Thumbnails"), "assets/icon.png", $this);
		$hover_thumb->addStyleControls(
            array(
                array(
                    "selector" => $selector." img:hover",
                    "property" => 'opacity',
				),
				
				array(
                    "selector" => $selector.":hover",
                    "property" => 'background-color',
                ),
            )
        );
		$hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Color"),
        		"selector" => $selector.":hover",
        		"property" => 'border-color',
        	)
		);
		$hover_thumb_borderWidth = $hover_thumb->addStyleControl(
        	array(
        		"name" => __("Border Width"),
        		"selector" => $selector.":hover",
        		"property" => 'border-width',
        	)
		);
		$hover_thumb_borderWidth->setUnits("px","px,em");
		$hover_thumb_box_shadow = $hover_thumb->addControlSection("tutor_hover_thumb_box_shadow", __("Box Shadow"), "assets/icon.png", $this);
		$hover_thumb_box_shadow->addPreset(
            "box-shadow",
            "tutor_hover_thumb_shadow",
            __("Hover Thumbs Shadow"),
            $selector.":hover"
        );
    }

}

new CourseThumbnail();