<?php


if ( ! function_exists( 'otlms_get_template' ) ) {
	/**
	 * Get template.
	 *
	 * @since 1.0.0
	 *
	 * @param array|string $template the template name.
	 *
	 * @return mixed|void
	 */
	function otlms_get_template( $template = null ) {
		$template = str_replace( '.', DIRECTORY_SEPARATOR, $template );

		$template_dir      = apply_filters( 'otlms_template_dir', OTLMS_PATH );
		$template_location = trailingslashit( $template_dir ) . "templates/{$template}.php";
		return apply_filters( 'otlms_get_template_path', $template_location, $template );
	}
}
