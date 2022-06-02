<?php


/**
 * @param null $template
 *
 * @return mixed|void
 *
 * @since v.1.0.0
 */

if ( ! function_exists('otlms_get_template')) {
	function otlms_get_template( $template = null ) {
		$template = str_replace( '.', DIRECTORY_SEPARATOR, $template );

		$template_dir = apply_filters('otlms_template_dir', OTLMS_PATH);
		$template_location = trailingslashit( $template_dir ) . "templates/{$template}.php";
		return apply_filters( 'otlms_get_template_path', $template_location, $template );
	}
}