<?php

if (class_exists('OxygenTutorElements')){
	return;
}

class OxygenTutorElements extends OxyEl {

	protected $params;

	function init() {

		$this->El->useAJAXControls();
		//$this->setAssetsPath( OXY_WOO_ASSETS_PATH );
	}

	function render($options, $defaults, $content) {
		if (method_exists($this, 'TutorTemplate')) {
			call_user_func($this->TutorTemplate());
		}
	}

	function class_names() {
		return array('oxy-tutor-element');
	}

	function controls() {

		//Les.Son.Compo.Nents
	}

	public function button_place() {
		$btn_place = $this->tutor_button_place();

		if ($btn_place){
			return "tutor::".$btn_place;
		}
		return "";
	}

}
